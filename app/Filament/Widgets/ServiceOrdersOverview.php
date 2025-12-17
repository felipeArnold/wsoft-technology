<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\ServiceOrder;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Date;

final class ServiceOrdersOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $today = Date::now();
        $startOfMonth = (clone $today)->startOfMonth();
        $endOfMonth = (clone $today)->endOfMonth();

        // Total de Ordens de Serviço
        $totalOrders = ServiceOrder::query()->count();

        // Ordens em Andamento
        $inProgressOrders = ServiceOrder::query()
            ->where('status', 'in_progress')
            ->count();

        // Ordens Concluídas este mês
        $completedThisMonth = ServiceOrder::query()
            ->where('status', 'completed')
            ->whereBetween('completion_date', [$startOfMonth, $endOfMonth])
            ->count();

        // Ordens Concluídas no mês anterior
        $startOfLastMonth = (clone $today)->subMonth()->startOfMonth();
        $endOfLastMonth = (clone $today)->subMonth()->endOfMonth();

        $completedLastMonth = ServiceOrder::query()
            ->where('status', 'completed')
            ->whereBetween('completion_date', [$startOfLastMonth, $endOfLastMonth])
            ->count();

        // Calcular variação percentual
        $completedVariation = $completedLastMonth > 0
            ? (($completedThisMonth - $completedLastMonth) / $completedLastMonth) * 100
            : 0;

        // Receita Total este mês
        $revenueThisMonth = (float) ServiceOrder::query()
            ->where('status', 'completed')
            ->whereBetween('completion_date', [$startOfMonth, $endOfMonth])
            ->sum('total_value');

        // Receita do mês anterior
        $revenueLastMonth = (float) ServiceOrder::query()
            ->where('status', 'completed')
            ->whereBetween('completion_date', [$startOfLastMonth, $endOfLastMonth])
            ->sum('total_value');

        // Calcular variação percentual de receita
        $revenueVariation = abs($revenueLastMonth) > 0.01
            ? (($revenueThisMonth - $revenueLastMonth) / abs($revenueLastMonth)) * 100
            : 0;

        // Ordens Atrasadas (sem data de conclusão mas já passou da data prevista)
        $overdueOrders = ServiceOrder::query()
            ->whereIn('status', ['draft', 'in_progress'])
            ->whereNotNull('expected_completion_date')
            ->whereDate('expected_completion_date', '<', $today)
            ->count();

        // Ordens Urgentes em Andamento
        $urgentOrders = ServiceOrder::query()
            ->where('status', 'in_progress')
            ->where('priority', 'urgent')
            ->count();

        return [
            Stat::make('Ordens em Andamento', $inProgressOrders)
                ->icon('heroicon-m-wrench-screwdriver')
                ->description($urgentOrders.' '.($urgentOrders === 1 ? 'urgente' : 'urgentes'))
                ->color('warning'),

            Stat::make('Concluídas este Mês', $completedThisMonth)
                ->icon('heroicon-m-check-circle')
                ->description(($completedVariation >= 0 ? '+ ' : '- ').number_format(abs($completedVariation), 1, ',', '.').'% vs mês anterior')
                ->color('success'),

            Stat::make('Receita do Mês', 'R$ '.number_format($revenueThisMonth, 2, ',', '.'))
                ->icon('heroicon-m-currency-dollar')
                ->description(($revenueVariation >= 0 ? '+ ' : '- ').number_format(abs($revenueVariation), 1, ',', '.').'% vs mês anterior')
                ->color($revenueThisMonth >= 0 ? 'success' : 'danger'),

            Stat::make('Ordens Atrasadas', $overdueOrders)
                ->icon('heroicon-m-exclamation-triangle')
                ->description($totalOrders.' '.($totalOrders === 1 ? 'ordem total' : 'ordens totais'))
                ->color($overdueOrders > 0 ? 'danger' : 'success'),
        ];
    }
}
