<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\RegisterTeam;
use App\Filament\Resources\Suggestions\SuggestionResource;
use App\Models\Tenant;
use Filament\Auth\MultiFactor\Email\EmailAuthentication;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Maartenpaauw\Filament\Cashier\Stripe\BillingProvider;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->emailChangeVerification()
            ->profile()
            ->tenant(
                Tenant::class,
                slugAttribute: 'slug'
            )
            ->tenantRegistration(RegisterTeam::class)
            ->multiFactorAuthentication([
                EmailAuthentication::make()->codeExpiryMinutes(2),
            ])
//            ->tenantBillingProvider(new BillingProvider('default'))
//            ->requiresTenantSubscription()
            ->navigationGroups([
                'Cadastros',
                'Financeiro',
                'Serviços',
                'Configurações',
            ])
            ->colors([
                'danger' => Color::Red,
                'gray' => Color::Gray,
                'info' => Color::hex('#3B82F6'),
                'primary' => Color::hex('#1E3A8A'),
                'success' => Color::Emerald,
                'warning' => Color::hex('#F59E0B'),
            ])
            ->topNavigation()
            ->brandLogo(fn () => view('components.logo'))
            ->favicon(asset('images/icon.webp'))
            ->brandLogo(asset('images/logo-azul.webp'))
            ->defaultThemeMode(ThemeMode::Light)
            ->darkModeBrandLogo(
                fn (): string => Auth::check()
                    ? asset('images/logo-azul.webp')
                    : asset('images/logo-branco.webp')
            )
            ->brandLogoHeight(fn (): string => Auth::check() ? '3rem' : '5rem')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->plugins([
                FilamentApexChartsPlugin::make(),
            ])
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->userMenuItems([
                'suggestion' => MenuItem::make()
                    ->label('Enviar Sugestão')
                    ->url(fn (): string => SuggestionResource::getUrl('create'))
                    ->icon('heroicon-o-light-bulb'),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
