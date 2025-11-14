<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Middleware\RedirectIfUserNotSubscribed;
use BackedEnum;
use Closure;
use Filament\Billing\Providers\Contracts\BillingProvider as BillingProviderContract;
use Filament\Pages\Dashboard;
use Illuminate\Http\RedirectResponse;
use Maartenpaauw\Filament\Cashier\TenantRepository;

final readonly class StripeBillingProvider implements BillingProviderContract
{
    /**
     * @param  string|BackedEnum|array<array-key, string|BackedEnum>  $plans
     */
    public function __construct(
        private string|BackedEnum|array $plans = 'default',
    ) {}

    public function getRouteAction(): string|Closure|array
    {
        return static function (): RedirectResponse {
            $tenant = TenantRepository::make()->current();

            if ($tenant->hasStripeId() === false) {
                $tenant->createAsStripeCustomer();
            }

            return $tenant->redirectToBillingPortal(returnUrl: Dashboard::getUrl());
        };
    }

    public function getSubscribedMiddleware(): string
    {
        return RedirectIfUserNotSubscribed::plan(plans: $this->plans);
    }
}
