<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use App\Models\Tenant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

final class MrrStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Total de empresas ativas com assinatura
        $activeSubscriptions = Tenant::whereHas('subscriptions', function ($query): void {
            $query->where('stripe_status', 'active')
                ->orWhere('stripe_status', 'trialing');
        })->count();

        // MRR (Monthly Recurring Revenue)
        $mrr = Tenant::whereHas('subscriptions', function ($query): void {
            $query->where('stripe_status', 'active');
        })->count() * 99; // Assumindo R$ 99/mês

        // Total de empresas cadastradas
        $totalTenants = Tenant::count();

        // Empresas em período de teste
        $trialTenants = Tenant::whereHas('subscriptions', function ($query): void {
            $query->where('stripe_status', 'trialing');
        })->count();

        // Taxa de conversão (trial para ativo)
        $conversionRate = $trialTenants > 0
            ? round(($activeSubscriptions / ($activeSubscriptions + $trialTenants)) * 100, 2)
            : 0;

        // Crescimento MRR mês anterior
        $lastMonthMrr = Tenant::whereHas('subscriptions', function ($query): void {
            $query->where('stripe_status', 'active')
                ->where('created_at', '<', now()->subMonth());
        })->count() * 99;

        $mrrGrowth = $lastMonthMrr > 0
            ? round((($mrr - $lastMonthMrr) / $lastMonthMrr) * 100, 2)
            : 0;

        return [
            Stat::make('MRR (Monthly Recurring Revenue)', 'R$ '.number_format($mrr, 2, ',', '.'))
                ->description($mrrGrowth >= 0 ? "+{$mrrGrowth}% em relação ao mês anterior" : "{$mrrGrowth}% em relação ao mês anterior")
                ->descriptionIcon($mrrGrowth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($mrrGrowth >= 0 ? 'success' : 'danger')
                ->chart([10, 15, 12, 20, 18, 25, $mrr / 10]),

            Stat::make('Assinaturas Ativas', $activeSubscriptions)
                ->description("De {$totalTenants} empresas cadastradas")
                ->descriptionIcon('heroicon-m-building-office')
                ->color('success'),

            Stat::make('Período de Teste', $trialTenants)
                ->description("Taxa de conversão: {$conversionRate}%")
                ->descriptionIcon('heroicon-m-clock')
                ->color('info'),

            Stat::make('Total de Empresas', $totalTenants)
                ->description('Cadastradas no sistema')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
        ];
    }
}
