<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Sales\Widgets;

use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Date;

final class SalesOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected int | string | array $columnSpan = 'full';

    protected ?string $pollingInterval = null;

    protected function getColumns(): int
    {
        return 4;
    }

    protected function getTablePage(): string
    {
        return \App\Filament\Resources\Financial\Sales\Pages\ListSales::class;
    }

    protected function getStats(): array
    {
        $query = $this->getPageTableQuery();

        $today = Date::now();

        $totalSales = (clone $query)->count();
        $totalAmount = (clone $query)->sum('total');
        $averageTicket = $totalSales > 0 ? $totalAmount / $totalSales : 0;

        $pendingSales = (clone $query)->where('status', 'pending')->count();
        $pendingAmount = (clone $query)->where('status', 'pending')->sum('total');

        $completedSales = (clone $query)->where('status', 'completed')->count();
        $completedAmount = (clone $query)->where('status', 'completed')->sum('total');

        $cancelledSales = (clone $query)->where('status', 'cancelled')->count();

        // Trend últimos 7 dias
        $trendData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = (clone $today)->subDays($i)->toDateString();
            $trendData[] = (clone $query)->whereDate('created_at', $date)->sum('total') / 100;
        }

        // Porcentagens
        $completedPercent = $totalSales > 0 ? round(($completedSales / $totalSales) * 100) : 0;
        $pendingPercent = $totalSales > 0 ? round(($pendingSales / $totalSales) * 100) : 0;

        return [
            Stat::make('Vendas', (string) $totalSales)
                ->icon('heroicon-o-shopping-cart')
                ->description("{$completedSales} concluídas · {$pendingSales} pendentes · {$cancelledSales} canceladas")
                ->color('primary')
                ->chart($trendData),
            Stat::make('Faturamento', 'R$ '.number_format((float) $totalAmount, 2, ',', '.'))
                ->icon('heroicon-o-banknotes')
                ->description('Ticket médio: R$ '.number_format((float) $averageTicket, 2, ',', '.'))
                ->color('success'),
            Stat::make('Concluídas', 'R$ '.number_format((float) $completedAmount, 2, ',', '.'))
                ->icon('heroicon-o-check-circle')
                ->description("{$completedSales} vendas ({$completedPercent}% do total)")
                ->color('success'),
            Stat::make('Pendentes', 'R$ '.number_format((float) $pendingAmount, 2, ',', '.'))
                ->icon('heroicon-o-clock')
                ->description("{$pendingSales} vendas ({$pendingPercent}% do total)")
                ->color('warning'),
        ];
    }
}
