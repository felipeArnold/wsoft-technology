<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use BackedEnum;
use Closure;
use Exception;
use Filament\Pages\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Laravel\Cashier\SubscriptionBuilder;
use Maartenpaauw\Filament\Cashier\Plan;
use Maartenpaauw\Filament\Cashier\PlanRepository;
use Maartenpaauw\Filament\Cashier\TenantRepository;
use Symfony\Component\HttpFoundation\Response;

final readonly class RedirectIfUserNotSubscribed
{
    public function __construct(
        private PlanRepository $repository,
    ) {}

    /**
     * @param  Closure(Request): (Response)  $next
     *
     * @throws Exception
     */
    public function handle(Request $request, Closure $next, string ...$plans): Response
    {
        $tenant = TenantRepository::make()->current();

        $instances = array_map(
            callback: fn (string $plan): Plan => $this->repository->get(name: $plan),
            array: $plans,
        );

        foreach ($instances as $plan) {
            if ($plan->hasGenericTrial === true && $tenant->onGenericTrial() === true) {
                return $next($request);
            }

            // IMPORTANT FIX: Check if tenant has ACTIVE subscription by stripe_status
            // This is more reliable than subscribedToProduct() which depends on subscription_items

            // Check for active or trialing subscriptions
            $activeSubscription = $tenant->subscriptions()
                ->where('type', $plan->type)
                ->whereIn('stripe_status', ['active', 'trialing'])
                ->exists();

            if ($activeSubscription) {
                \Log::info('Tenant has active subscription, allowing access', [
                    'tenant_id' => $tenant->id,
                    'plan_type' => $plan->type,
                ]);

                return $next($request);
            }

            // Check for past_due subscriptions with grace period
            // Allow access if payment failed but still within grace period
            $pastDueSubscription = $tenant->subscriptions()
                ->where('type', $plan->type)
                ->where('stripe_status', 'past_due')
                ->first();

            if ($pastDueSubscription) {
                $gracePeriodDays = config('cashier.past_due_grace_period', 7);

                // If ends_at is set and in the future, allow access (grace period active)
                if ($pastDueSubscription->ends_at && $pastDueSubscription->ends_at->isFuture()) {
                    \Log::info('Tenant has past_due subscription within grace period, allowing access', [
                        'tenant_id' => $tenant->id,
                        'plan_type' => $plan->type,
                        'ends_at' => $pastDueSubscription->ends_at->format('Y-m-d H:i:s'),
                        'days_remaining' => now()->diffInDays($pastDueSubscription->ends_at, false),
                    ]);

                    return $next($request);
                }

                // Grace period expired, log and continue to checkout
                \Log::warning('Tenant has past_due subscription with expired grace period, redirecting to checkout', [
                    'tenant_id' => $tenant->id,
                    'plan_type' => $plan->type,
                    'ends_at' => $pastDueSubscription->ends_at?->format('Y-m-d H:i:s'),
                ]);
            }

            // Fallback: Check if tenant is subscribed using Laravel Cashier method
            // This requires subscription_items to be populated
            if ($tenant->subscribedToProduct(products: $plan->productId, type: $plan->type) === true) {
                return $next($request);
            }

            // Additional check: if tenant has any subscription (even canceled/expired)
            // Log this for debugging
            if ($tenant->subscriptions()->exists() && ! $activeSubscription) {
                \Log::info('Tenant has subscription but not active, will redirect to checkout', [
                    'tenant_id' => $tenant->id,
                    'subscriptions_count' => $tenant->subscriptions()->count(),
                    'has_trial_ends_at' => $tenant->trial_ends_at !== null,
                ]);
            }
        }

        /** @var Plan $plan */
        $plan = Arr::first(array: $instances);

        // FIX: Add line_items with quantity to the checkout session
        // Get quantity from global cashier config
        $quantity = config('cashier.quantity', 1);

        $checkoutOptions = [
            'line_items' => [
                [
                    'price' => $plan->priceId,
                    'quantity' => $quantity,
                ],
            ],
        ];

        $isEligibleForTrial = $tenant->isEligibleForTrial($request->user());

        // Log detalhado para debug de trial eligibility
        \Log::info('Trial eligibility check', [
            'tenant_id' => $tenant->id,
            'tenant_name' => $tenant->name,
            'is_eligible' => $isEligibleForTrial,
            'subscriptions_count' => $tenant->subscriptions()->count(),
            'has_trial_ends_at' => $tenant->trial_ends_at !== null,
            'trial_ends_at_value' => $tenant->trial_ends_at?->format('Y-m-d H:i:s'),
            'user_id' => $request->user()?->id,
            'plan_trial_days' => $plan->trialDays,
            'will_apply_trial' => ($plan->hasGenericTrial === false && $plan->trialDays !== false && $isEligibleForTrial),
        ]);

        return $tenant
            ->newSubscription(type: $plan->type, prices: $plan->isMeteredPrice ? [] : $plan->priceId)
            ->when(
                value: $plan->isMeteredPrice === true,
                callback: static fn (SubscriptionBuilder $subscription): SubscriptionBuilder => $subscription->meteredPrice(price: $plan->priceId),
            )
            ->when(
                value: $plan->hasGenericTrial === false
                    && $plan->trialDays !== false
                    && $isEligibleForTrial,
                callback: static fn (SubscriptionBuilder $subscription): SubscriptionBuilder => $subscription->trialDays(trialDays: $plan->trialDays),
            )
            ->when(
                value: $plan->allowPromotionCodes === true,
                callback: static fn (SubscriptionBuilder $subscription): SubscriptionBuilder => $subscription->allowPromotionCodes(),
            )
            ->when(
                value: $plan->collectTaxIds === true,
                callback: static fn (SubscriptionBuilder $subscription): SubscriptionBuilder => $subscription->collectTaxIds(),
            )
            ->checkout(
                sessionOptions: [
                    'success_url' => Dashboard::getUrl(),
                    'cancel_url' => Dashboard::getUrl(),
                ],
                checkoutOptions: $checkoutOptions
            )
            ->redirect();
    }

    /**
     * @param  string|BackedEnum|array<array-key, string|BackedEnum>  $plans
     */
    public static function plan(string|BackedEnum|array $plans = 'default'): string
    {
        return sprintf(
            '%s:%s',
            self::class,
            Collection::wrap(value: $plans)
                ->map(callback: static fn (string|BackedEnum $plan): string => match (true) {
                    $plan instanceof BackedEnum => strval(value: $plan->value),
                    default => $plan,
                })
                ->join(glue: ','),
        );
    }
}
