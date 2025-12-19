<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\Commission\CommissionStatusEnum;
use App\Models\Commission;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Date;

final class CommissionsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $today = Date::now();
        $startOfMonth = (clone $today)->startOfMonth();
        $endOfMonth = (clone $today)->endOfMonth();

        // Comissões do mês atual
        $commissionsQuery = Commission::query()
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);

        $totalCommissions = (float) (clone $commissionsQuery)->sum('commission_amount');
        $countCommissions = (int) (clone $commissionsQuery)->count();

        // Comissões pagas no mês
        $paidCommissions = (float) Commission::query()
            ->where('status', CommissionStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->sum('commission_amount');

        $countPaidCommissions = (int) Commission::query()
            ->where('status', CommissionStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->count();

        // Comissões pendentes
        $pendingCommissions = (float) Commission::query()
            ->where('status', CommissionStatusEnum::PENDING)
            ->sum('commission_amount');

        $countPendingCommissions = (int) Commission::query()
            ->where('status', CommissionStatusEnum::PENDING)
            ->count();

        // Calcular mês anterior para comparação
        $startOfLastMonth = (clone $today)->subMonth()->startOfMonth();
        $endOfLastMonth = (clone $today)->subMonth()->endOfMonth();

        $lastMonthTotal = (float) Commission::query()
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum('commission_amount');

        // Variação percentual
        $variation = abs($lastMonthTotal) > 0.01
            ? (($totalCommissions - $lastMonthTotal) / abs($lastMonthTotal)) * 100
            : 0;

        // Comissão média
        $averageCommission = $countCommissions > 0 ? $totalCommissions / $countCommissions : 0;

        return [
            Stat::make('Comissões do Mês', 'R$ '.number_format($totalCommissions, 2, ',', '.'))
                ->icon('heroicon-m-currency-dollar')
                ->description(($variation >= 0 ? '+ ' : '- ').number_format(abs($variation), 1, ',', '.').'% vs mês anterior')
                ->descriptionIcon($variation >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($variation >= 0 ? 'success' : 'danger')
                ->chart($this->getMonthlyTrend()),

            Stat::make('Comissões Pagas', 'R$ '.number_format($paidCommissions, 2, ',', '.'))
                ->icon('heroicon-m-check-circle')
                ->description($countPaidCommissions.' '.($countPaidCommissions === 1 ? 'comissão paga' : 'comissões pagas'))
                ->color('success'),

            Stat::make('Comissões Pendentes', 'R$ '.number_format($pendingCommissions, 2, ',', '.'))
                ->icon('heroicon-m-clock')
                ->description($countPendingCommissions.' '.($countPendingCommissions === 1 ? 'comissão pendente' : 'comissões pendentes'))
                ->color('warning'),

            Stat::make('Comissão Média', 'R$ '.number_format($averageCommission, 2, ',', '.'))
                ->icon('heroicon-m-calculator')
                ->description('Baseado em '.$countCommissions.' '.($countCommissions === 1 ? 'comissão' : 'comissões'))
                ->color('info'),
        ];
    }

    private function getMonthlyTrend(): array
    {
        $today = Date::now();
        $startDate = (clone $today)->subDays(29)->startOfDay();
        $endDate = (clone $today)->endOfDay();

        // Buscar todas as comissões dos últimos 30 dias
        $results = Commission::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('date(created_at) as date, SUM(commission_amount) as total')
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        $trend = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = (clone $today)->subDays($i)->format('Y-m-d');
            $trend[] = (float) ($results->get($date)?->total ?? 0);
        }

        return $trend;
    }
}
