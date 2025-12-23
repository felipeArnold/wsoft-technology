<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Tenant;
use App\Policies\TenantPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Model::automaticallyEagerLoadRelationships();
        Cashier::useCustomerModel(Tenant::class);

        URL::forceHttps(app()->isProduction());

        Gate::policy(Tenant::class, TenantPolicy::class);

        $this->configureRateLimiters();
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiters(): void
    {
        // Rate limiter para rotas web em geral
        RateLimiter::for('web', function (Request $request) {
            return Limit::perMinute(120)->by($request->user()?->id ?: $request->ip());
        });

        // Rate limiter para APIs em geral
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Rate limiter para login (mais restritivo)
        RateLimiter::for('login', function (Request $request) {
            if ($request->isMethod('POST') &&
                (str_contains($request->path(), 'login') ||
                 str_contains($request->path(), 'auth'))) {
                $email = $request->input('email', $request->input('data.email', ''));

                return Limit::perMinute(5)->by($email.$request->ip());
            }

            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
