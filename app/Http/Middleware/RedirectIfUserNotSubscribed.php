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

            if ($tenant->subscribedToProduct(products: $plan->productId, type: $plan->type) === true) {
                return $next($request);
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

        // Verificar se o tenant já teve uma subscription anteriormente (trial expirado)
        $hadPreviousSubscription = $tenant->subscriptions()->count() > 0;

        return $tenant
            ->newSubscription(type: $plan->type, prices: $plan->isMeteredPrice ? [] : $plan->priceId)
            ->when(
                value: $plan->isMeteredPrice === true,
                callback: static fn (SubscriptionBuilder $subscription): SubscriptionBuilder => $subscription->meteredPrice(price: $plan->priceId),
            )
            ->when(
                value: $plan->hasGenericTrial === false && $plan->trialDays !== false && ! $hadPreviousSubscription,
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
