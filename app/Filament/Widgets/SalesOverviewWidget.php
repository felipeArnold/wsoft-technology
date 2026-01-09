<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Sale;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

final class SalesOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static bool $isLazy = true;

    protected ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $tenant = Filament::getTenant();

        $query = Sale::query();

        if ($tenant) {
            $query->where('tenant_id', $tenant->id);
        }

        $currentMonthQuery = clone $query;
        $currentMonthQuery->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);

        $lastMonthQuery = clone $query;
        $lastMonthQuery->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year);

        $currentMonthRevenue = $currentMonthQuery->sum('total');
        $currentMonthSales = $currentMonthQuery->count();
        $lastMonthRevenue = $lastMonthQuery->sum('total');
        $lastMonthSales = $lastMonthQuery->count();

        $revenueChange = $lastMonthRevenue > 0
            ? (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
            : 0;

        $salesChange = $lastMonthSales > 0
            ? (($currentMonthSales - $lastMonthSales) / $lastMonthSales) * 100
            : 0;

        $averageTicket = $currentMonthSales > 0
            ? $currentMonthRevenue / $currentMonthSales
            : 0;

        $totalRevenue = $query->sum('total');
        $totalSales = $query->count();

        $last7Days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dailyRevenue = (clone $query)
                ->whereDate('created_at', $date)
                ->sum('total');
            $last7Days[] = (float) $dailyRevenue;
        }

        return [
            Stat::make('Receita do Mês', 'R$ '.number_format($currentMonthRevenue, 2, ',', '.'))
                ->description(
                    abs($revenueChange) > 0
                        ? ($revenueChange > 0 ? '+' : '').number_format($revenueChange, 1, ',', '.').'% vs mês anterior'
                        : 'Sem comparação'
                )
                ->descriptionIcon($revenueChange > 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($revenueChange >= 0 ? 'success' : 'danger')
                ->chart($last7Days),

            Stat::make('Vendas do Mês', $currentMonthSales)
                ->description(
                    abs($salesChange) > 0
                        ? ($salesChange > 0 ? '+' : '').number_format($salesChange, 1, ',', '.').'% vs mês anterior'
                        : 'Sem comparação'
                )
                ->descriptionIcon($salesChange > 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($salesChange >= 0 ? 'success' : 'danger'),

            Stat::make('Ticket Médio', 'R$ '.number_format($averageTicket, 2, ',', '.'))
                ->description('Média do mês atual')
                ->descriptionIcon('heroicon-o-shopping-cart')
                ->color('info'),

            Stat::make('Receita Total', 'R$ '.number_format($totalRevenue, 2, ',', '.'))
                ->description($totalSales.' vendas realizadas')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),
        ];
    }
}
