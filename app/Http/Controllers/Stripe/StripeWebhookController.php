<?php

declare(strict_types=1);

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Subscription;
use Stripe\Webhook;

final class StripeWebhookController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (Exception $e) {
            Log::error('Stripe webhook signature verification failed', ['error' => $e->getMessage()]);

            return response()->json(['error' => 'Invalid signature'], 400);
        }

        try {
            match ($event->type) {
                'customer.updated' => $this->handleCustomerUpdated($event->data->object),
                'customer.subscription.created' => $this->handleSubscriptionCreated($event->data->object),
                'customer.subscription.updated' => $this->handleSubscriptionUpdated($event->data->object),
                'customer.subscription.deleted' => $this->handleSubscriptionDeleted($event->data->object),
                'customer.subscription.trial_will_end' => $this->handleTrialWillEnd($event->data->object),
                'invoice.payment_succeeded' => $this->handlePaymentSucceeded($event->data->object),
                'invoice.payment_failed' => $this->handlePaymentFailed($event->data->object),
                default => Log::info('Unhandled webhook event', ['type' => $event->type])
            };

            return response()->json(['message' => 'Webhook handled successfully'], 200);
        } catch (Exception $e) {
            Log::error('Error processing webhook', [
                'type' => $event->type,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['error' => 'Error processing webhook'], 500);
        }
    }

    private function handleCustomerUpdated(object $customer): void
    {
        $tenant = Tenant::query()->where('stripe_id', $customer->id)->first();

        if (! $tenant) {
            Log::warning('Tenant not found for customer', ['customer_id' => $customer->id]);

            return;
        }

        $updateData = [];

        if (isset($customer->email)) {
            $updateData['email'] = $customer->email;
        }

        if (isset($customer->name)) {
            $updateData['name'] = $customer->name;
        }

        // Atualizar payment method
        if (isset($customer->invoice_settings->default_payment_method)) {
            $pmId = $customer->invoice_settings->default_payment_method;

            try {
                // Buscar detalhes do payment method através da API do Stripe
                $paymentMethod = $tenant->stripe()->paymentMethods->retrieve($pmId);

                if ($paymentMethod) {
                    $updateData['pm_type'] = $paymentMethod->type;

                    if ($paymentMethod->type === 'card' && isset($paymentMethod->card->last4)) {
                        $updateData['pm_last_four'] = $paymentMethod->card->last4;
                    }
                }
            } catch (Exception $e) {
                Log::warning('Failed to retrieve payment method', [
                    'customer_id' => $customer->id,
                    'pm_id' => $pmId,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        // Atualizar trial_ends_at baseado na subscription ativa
        $activeSubscription = $tenant->subscriptions()
            ->whereIn('stripe_status', ['trialing', 'active'])
            ->first();

        if ($activeSubscription && $activeSubscription->trial_ends_at) {
            $updateData['trial_ends_at'] = $activeSubscription->trial_ends_at;
        }

        if (! empty($updateData)) {
            $tenant->update($updateData);
        }

        Log::info('Customer updated', ['tenant_id' => $tenant->id, 'stripe_customer_id' => $customer->id]);
    }

    private function handleSubscriptionCreated(object $stripeSubscription): void
    {
        $tenant = Tenant::where('stripe_id', $stripeSubscription->customer)->first();

        if (! $tenant) {
            Log::warning('Tenant not found for subscription', ['customer_id' => $stripeSubscription->customer]);

            return;
        }

        $subscription = $tenant->subscriptions()->updateOrCreate(
            ['stripe_id' => $stripeSubscription->id],
            [
                'type' => $stripeSubscription->items->data[0]->price->product->name ?? 'default',
                'stripe_status' => $stripeSubscription->status,
                'stripe_price' => $stripeSubscription->items->data[0]->price->id ?? null,
                'quantity' => $stripeSubscription->items->data[0]->quantity ?? 1,
                'trial_ends_at' => $stripeSubscription->trial_end ? date('Y-m-d H:i:s', $stripeSubscription->trial_end) : null,
                'ends_at' => null,
            ]
        );

        // Create subscription items - CRITICAL for Laravel Cashier
        foreach ($stripeSubscription->items->data as $item) {
            $subscription->items()->updateOrCreate(
                ['stripe_id' => $item->id],
                [
                    'stripe_product' => $item->price->product,
                    'stripe_price' => $item->price->id,
                    'quantity' => $item->quantity ?? 1,
                ]
            );
        }

        Log::info('Subscription created', [
            'tenant_id' => $tenant->id,
            'subscription_id' => $subscription->id,
            'stripe_subscription_id' => $stripeSubscription->id,
            'items_count' => count($stripeSubscription->items->data),
        ]);
    }

    private function handleSubscriptionUpdated(object $stripeSubscription): void
    {
        $subscription = Subscription::where('stripe_id', $stripeSubscription->id)->first();

        if (! $subscription) {
            Log::warning('Subscription not found', ['stripe_subscription_id' => $stripeSubscription->id]);
            $this->handleSubscriptionCreated($stripeSubscription);

            return;
        }

        $subscription->update([
            'stripe_status' => $stripeSubscription->status,
            'stripe_price' => $stripeSubscription->items->data[0]->price->id ?? $subscription->stripe_price,
            'quantity' => $stripeSubscription->items->data[0]->quantity ?? $subscription->quantity,
            'trial_ends_at' => $stripeSubscription->trial_end ? date('Y-m-d H:i:s', $stripeSubscription->trial_end) : $subscription->trial_ends_at,
            'ends_at' => $stripeSubscription->cancel_at ? date('Y-m-d H:i:s', $stripeSubscription->cancel_at) : null,
        ]);

        // Update subscription items
        foreach ($stripeSubscription->items->data as $item) {
            $subscription->items()->updateOrCreate(
                ['stripe_id' => $item->id],
                [
                    'stripe_product' => $item->price->product,
                    'stripe_price' => $item->price->id,
                    'quantity' => $item->quantity ?? 1,
                ]
            );
        }

        Log::info('Subscription updated', [
            'subscription_id' => $subscription->id,
            'stripe_subscription_id' => $stripeSubscription->id,
            'status' => $stripeSubscription->status,
        ]);
    }

    private function handleSubscriptionDeleted(object $stripeSubscription): void
    {
        $subscription = Subscription::where('stripe_id', $stripeSubscription->id)->first();

        if (! $subscription) {
            Log::warning('Subscription not found for deletion', ['stripe_subscription_id' => $stripeSubscription->id]);

            return;
        }

        $subscription->update([
            'stripe_status' => 'canceled',
            'ends_at' => now(),
        ]);

        Log::info('Subscription deleted', [
            'subscription_id' => $subscription->id,
            'stripe_subscription_id' => $stripeSubscription->id,
        ]);
    }

    private function handlePaymentSucceeded(object $invoice): void
    {
        if (! $invoice->subscription) {
            return;
        }

        $subscription = Subscription::where('stripe_id', $invoice->subscription)->first();

        if (! $subscription) {
            Log::warning('Subscription not found for payment', ['stripe_subscription_id' => $invoice->subscription]);

            return;
        }

        $subscription->update([
            'stripe_status' => 'active',
            'ends_at' => null,
        ]);

        Log::info('Payment succeeded, subscription activated', [
            'subscription_id' => $subscription->id,
            'stripe_subscription_id' => $invoice->subscription,
            'invoice_id' => $invoice->id,
        ]);
    }

    private function handleTrialWillEnd(object $stripeSubscription): void
    {
        $subscription = Subscription::where('stripe_id', $stripeSubscription->id)->first();

        if (! $subscription) {
            Log::warning('Subscription not found for trial ending', ['stripe_subscription_id' => $stripeSubscription->id]);

            return;
        }

        $tenant = $subscription->owner;

        if (! $tenant) {
            Log::warning('Tenant not found for subscription', ['subscription_id' => $subscription->id]);

            return;
        }

        // Verificar se há um método de pagamento configurado
        if (! $tenant->hasDefaultPaymentMethod()) {
            Log::warning('No payment method configured for tenant with ending trial', [
                'tenant_id' => $tenant->id,
                'subscription_id' => $subscription->id,
            ]);
        }

        // Notificar todos os usuários do tenant
        $users = $tenant->users;
        if ($users->isNotEmpty()) {
            Notification::send($users, new TrialEndingSoonNotification($tenant, $subscription));

            Log::info('Trial ending notification sent', [
                'tenant_id' => $tenant->id,
                'subscription_id' => $subscription->id,
                'users_count' => $users->count(),
            ]);
        }
    }

    private function handlePaymentFailed(object $invoice): void
    {
        if (! $invoice->subscription) {
            return;
        }

        $subscription = Subscription::where('stripe_id', $invoice->subscription)->first();

        if (! $subscription) {
            Log::warning('Subscription not found for failed payment', ['stripe_subscription_id' => $invoice->subscription]);

            return;
        }

        // Marcar como past_due e definir uma data de bloqueio (7 dias de grace period)
        $gracePeriodDays = config('cashier.past_due_grace_period', 7);

        $subscription->update([
            'stripe_status' => 'past_due',
            'ends_at' => now()->addDays($gracePeriodDays),
        ]);

        // Notificar o tenant sobre a falha no pagamento
        $tenant = $subscription->owner;
        if ($tenant) {
            $users = $tenant->users;
            if ($users->isNotEmpty()) {
                // TODO: Criar notificação de falha de pagamento
                Log::info('Payment failed, users should be notified', [
                    'tenant_id' => $tenant->id,
                    'subscription_id' => $subscription->id,
                ]);
            }
        }

        Log::info('Payment failed, subscription marked as past due with grace period', [
            'subscription_id' => $subscription->id,
            'stripe_subscription_id' => $invoice->subscription,
            'invoice_id' => $invoice->id,
            'ends_at' => $subscription->ends_at,
        ]);
    }
}
