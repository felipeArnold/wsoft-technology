<?php

declare(strict_types=1);

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class StripeBillingController extends Controller
{
    /**
     * Redirect to Stripe Billing Portal
     */
    public function billingPortal(Request $request, Tenant $tenant): RedirectResponse
    {

        return $tenant->redirectToBillingPortal(route('filament.app.pages.dashboard'));
    }

    /**
     * View tenant invoices
     */
    public function invoices(Request $request, Tenant $tenant)
    {
        $invoices = $tenant->invoices();

        return view('stripe.invoices', [
            'tenant' => $tenant,
            'invoices' => $invoices,
        ]);
    }

    /**
     * Download a specific invoice
     */
    public function downloadInvoice(Request $request, Tenant $tenant, string $invoiceId)
    {

        return $tenant->downloadInvoice($invoiceId, [
            'vendor' => config('app.name'),
            'product' => 'Assinatura',
        ]);
    }

    /**
     * Cancel subscription
     */
    public function cancelSubscription(Request $request, Tenant $tenant): JsonResponse
    {

        try {
            $subscription = $tenant->subscription('default');

            if (! $subscription) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhuma assinatura ativa encontrada.',
                ], 404);
            }

            if ($subscription->onGracePeriod()) {
                return response()->json([
                    'success' => false,
                    'message' => 'A assinatura já está cancelada.',
                ], 400);
            }

            $subscription->cancel();

            return response()->json([
                'success' => true,
                'message' => 'Assinatura cancelada com sucesso. Você terá acesso até o fim do período de cobrança.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cancelar assinatura: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Resume subscription
     */
    public function resumeSubscription(Request $request, Tenant $tenant): JsonResponse
    {

        try {
            $subscription = $tenant->subscription('default');

            if (! $subscription) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhuma assinatura encontrada.',
                ], 404);
            }

            if (! $subscription->onGracePeriod()) {
                return response()->json([
                    'success' => false,
                    'message' => 'A assinatura não está cancelada.',
                ], 400);
            }

            $subscription->resume();

            return response()->json([
                'success' => true,
                'message' => 'Assinatura reativada com sucesso!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao reativar assinatura: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Redirect to checkout
     */
    public function checkout(Request $request, Tenant $tenant): RedirectResponse
    {

        if ($tenant->subscribed('default')) {
            return redirect()->route('filament.app.pages.dashboard')
                ->with('error', 'Você já possui uma assinatura ativa.');
        }

        $priceId = config('cashier.plans.default.price_id');

        return $tenant
            ->newSubscription('default', $priceId)
            ->trialDays(config('cashier.plans.default.trial_days', 7))
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('filament.app.pages.dashboard').'?checkout=success',
                'cancel_url' => route('filament.app.pages.dashboard').'?checkout=cancel',
            ]);
    }
}
