<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\Commission\CommissionStatusEnum;
use App\Models\Commission;
use Carbon\Carbon;
use Filament\Support\RawJs;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class CommissionsTrendChart extends ApexChartWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $chartId = 'commissionsTrendChart';

    protected static ?string $heading = 'Evolução de Comissões';

    protected static ?string $subheading = 'Últimos 30 dias';

    protected function getOptions(): array
    {
        $days = [];
        $totalCommissionsData = [];
        $paidCommissionsData = [];
        $pendingCommissionsData = [];

        // Calcular período dos últimos 30 dias
        $startDate = Carbon::now()->subDays(29)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Detectar o driver do banco de dados
        $driver = DB::getDriverName();
        $dateFormatSql = $driver === 'sqlite'
            ? "strftime('%Y-%m-%d', created_at)"
            : "DATE_FORMAT(created_at, '%Y-%m-%d')";

        // Query para total de comissões criadas por dia
        $totalResults = Commission::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw("
                $dateFormatSql as day,
                SUM(commission_amount) as total
            ")
            ->groupBy('day')
            ->get()
            ->keyBy('day');

        // Query para comissões pagas por dia
        $paidResults = Commission::query()
            ->where('status', CommissionStatusEnum::PAID)
            ->whereBetween('paid_at', [$startDate, $endDate])
            ->selectRaw('
                '.($driver === 'sqlite' ? "strftime('%Y-%m-%d', paid_at)" : "DATE_FORMAT(paid_at, '%Y-%m-%d')").' as day,
                SUM(commission_amount) as total
            ')
            ->groupBy('day')
            ->get()
            ->keyBy('day');

        // Processar dados para os últimos 30 dias
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayKey = $date->format('Y-m-d');

            $days[] = $date->format('d/m');
            $totalCommissionsData[] = (float) ($totalResults->get($dayKey)?->total ?? 0);
            $paidCommissionsData[] = (float) ($paidResults->get($dayKey)?->total ?? 0);

            // Pendente = Total criado - Pago
            $total = (float) ($totalResults->get($dayKey)?->total ?? 0);
            $paid = (float) ($paidResults->get($dayKey)?->total ?? 0);
            $pendingCommissionsData[] = max(0, $total - $paid);
        }

        return [
            'chart' => [
                'type' => 'area',
                'height' => 350,
                'toolbar' => [
                    'show' => true,
                ],
                'stacked' => false,
            ],
            'series' => [
                [
                    'name' => 'Total Gerado',
                    'data' => $totalCommissionsData,
                ],
                [
                    'name' => 'Pago',
                    'data' => $paidCommissionsData,
                ],
                [
                    'name' => 'Pendente',
                    'data' => $pendingCommissionsData,
                ],
            ],
            'stroke' => [
                'curve' => 'smooth',
                'width' => 2,
            ],
            'fill' => [
                'type' => 'gradient',
                'gradient' => [
                    'shadeIntensity' => 1,
                    'opacityFrom' => 0.4,
                    'opacityTo' => 0.1,
                ],
            ],
            'xaxis' => [
                'categories' => $days,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'title' => [
                    'text' => 'Valor (R$)',
                ],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#3b82f6', '#10b981', '#f59e0b'],
            'dataLabels' => [
                'enabled' => false,
            ],
            'markers' => [
                'size' => 0,
            ],
            'tooltip' => [
                'enabled' => true,
                'shared' => true,
                'intersect' => false,
            ],
            'grid' => [
                'show' => true,
            ],
            'legend' => [
                'show' => true,
                'position' => 'top',
                'horizontalAlign' => 'left',
            ],
        ];
    }
}
