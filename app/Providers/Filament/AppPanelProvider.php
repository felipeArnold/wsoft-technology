<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Clusters\Settings\Categories\CategoryResource;
use App\Filament\Clusters\Settings\Companies\CompanyResource;
use App\Filament\Clusters\Settings\CRM\Funnels\FunnelResource;
use App\Filament\Clusters\Settings\CRM\LossReasons\LossReasonResource;
use App\Filament\Clusters\Settings\CRM\Sources\SourceResource;
use App\Filament\Clusters\Settings\CRM\Teams\TeamResource;
use App\Filament\Clusters\Settings\EmailTemplates\EmailTemplateResource;
use App\Filament\Clusters\Settings\Services\ServiceResource;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Filament\Clusters\Settings\Users\UserResource;
use App\Filament\Pages\Auth\RegisterTeam;
use App\Filament\Pages\Auth\RegisterUser;
use App\Filament\Pages\Dashboard;
use App\Filament\Resources\Creates\Products\ProductResource;
use App\Filament\Resources\Creates\Vehicles\VehicleResource;
use App\Filament\Resources\Financial\Commissions\CommissionResource;
use App\Filament\Resources\Financial\Extracts\ExtractResource;
use App\Filament\Resources\Financial\NonPayments\NonPaymentResource;
use App\Filament\Resources\Services\DigitalSignature\Envelopes\EnvelopeResource;
use App\Filament\Resources\Services\Warranties\WarrantyResource;
use App\Filament\Resources\Stock\StockInventories\StockInventoryResource;
use App\Filament\Resources\Stock\StockMovements\StockMovementResource;
use App\Filament\Resources\Suggestions\SuggestionResource;
use App\Models\Tenant;
use App\Notifications\MultiFactorAuthenticationCode;
use Awcodes\QuickCreate\QuickCreatePlugin;
use Filament\Actions\Action;
use Filament\Auth\MultiFactor\App\AppAuthentication;
use Filament\Auth\MultiFactor\Email\EmailAuthentication;
use Filament\Enums\ThemeMode;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Maartenpaauw\Filament\Cashier\Stripe\BillingProvider;

final class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('app')
            ->login()
            ->registration(RegisterUser::class)
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
                AppAuthentication::make()
                    ->recoverable()
                    ->recoveryCodeCount(5),
                EmailAuthentication::make()
                    ->codeExpiryMinutes(5)
                    ->codeNotification(MultiFactorAuthenticationCode::class),
            ])
            ->navigationGroups([
                'Cadastros',
                'Financeiro',
                'Serviços',
                'Vendas',
                'Estoque',
            ])
            ->userMenuItems([
                Action::make('settings')
                    ->label('Configuração')
                    ->url(fn (): string => SettingsCluster::getNavigationUrl())
                    ->icon('heroicon-o-cog-6-tooth')
                    ->visible(fn (): bool => Filament::getTenant() !== null),
                Action::make('billing')
                    ->label('Gerenciar Assinatura')
                    ->url(fn (): string => Filament::getTenant()
                        ? route('filament.app.tenant.billing', ['tenant' => Filament::getTenant()])
                        : '#')
                    ->icon('heroicon-o-credit-card')
                    ->visible(fn (): bool => Filament::getTenant() !== null),
                Action::make('suggestions')
                    ->label('Sugestões')
                    ->url(fn (): string => Filament::getTenant()
                        ? SuggestionResource::getUrl('index')
                        : '#')
                    ->icon('heroicon-o-light-bulb')
                    ->visible(fn (): bool => Filament::getTenant() !== null),
            ])
            ->tenantMenuItems([
                Action::make('settings')
                    ->label('Configuração')
                    ->url(fn (): string => SettingsCluster::getNavigationUrl())
                    ->icon('heroicon-o-cog-6-tooth')
                    ->visible(fn (): bool => Filament::getTenant() !== null),
            ])
            ->colors([
                'danger' => Color::Red,
                'gray' => Color::Gray,
                'info' => Color::hex('#3B82F6'),
                'primary' => Color::hex('#1d4ed8'),
                'success' => Color::Emerald,
                'warning' => Color::hex('#F59E0B'),
            ])
            ->maxContentWidth(Width::Full)
            ->tenantBillingProvider(new BillingProvider('default'))
            ->requiresTenantSubscription()
            ->errorNotifications(false)
            ->databaseNotifications()
            ->sidebarFullyCollapsibleOnDesktop()
            ->brandLogo(fn () => view('components.logo'))
            ->favicon(asset('images/icon.webp'))
            ->brandLogo(asset('images/logo.png'))
            ->defaultThemeMode(ThemeMode::Light)
            ->darkModeBrandLogo(
                fn (): string => Auth::check()
                    ? asset('images/logo-white.png')
                    : asset('images/logo.png')
            )
            ->brandLogoHeight(fn (): string => Auth::check() ? '3rem' : '5rem')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->plugins([
                FilamentApexChartsPlugin::make(),
                QuickCreatePlugin::make()
                    ->excludes([
                        CommissionResource::class,
                        NonPaymentResource::class,
                        EnvelopeResource::class,
                        VehicleResource::class,
                        CategoryResource::class,
                        CompanyResource::class,
                        FunnelResource::class,
                        LossReasonResource::class,
                        SourceResource::class,
                        TeamResource::class,
                        ServiceResource::class,
                        UserResource::class,
                        StockInventoryResource::class,
                        StockMovementResource::class,
                        WarrantyResource::class,
                        EmailTemplateResource::class,
                        ProductResource::class,
                        ExtractResource::class,
                    ]),
            ])
            ->renderHook(
                'panels::head.end',
                fn (): string => view('filament.vite-assets')->render()
            )
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
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
                'throttle:login',
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
