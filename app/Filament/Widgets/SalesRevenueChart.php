<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Sale;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class SalesRevenueChart extends ApexChartWidget
{
    protected static ?string $heading = 'Receita de Vendas (Últimos 30 dias)';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected ?string $pollingInterval = null;

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();

        $sales = Sale::query()
            ->select([
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total) as total_revenue'),
                DB::raw('COUNT(*) as total_sales'),
            ])
            ->when($tenant, fn ($query) => $query->where('tenant_id', $tenant->id))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $dates = collect();
        for ($i = 29; $i >= 0; $i--) {
            $dates->push(now()->subDays($i)->format('Y-m-d'));
        }

        $revenues = [];
        $salesCount = [];
        $labels = [];

        foreach ($dates as $date) {
            $labels[] = \Carbon\Carbon::parse($date)->format('d/m');

            $sale = $sales->get($date);

            $revenues[] = $sale ? (float) $sale->total_revenue : 0;
            $salesCount[] = $sale ? (int) $sale->total_sales : 0;
        }

        return [
            'chart' => [
                'type' => 'line',
                'height' => 350,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'Receita (R$)',
                    'type' => 'column',
                    'data' => $revenues,
                ],
                [
                    'name' => 'Número de Vendas',
                    'type' => 'line',
                    'data' => $salesCount,
                ],
            ],
            'stroke' => [
                'width' => [0, 4],
                'curve' => 'smooth',
            ],
            'plotOptions' => [
                'bar' => [
                    'columnWidth' => '50%',
                ],
            ],
            'fill' => [
                'opacity' => [0.85, 1],
            ],
            'labels' => $labels,
            'markers' => [
                'size' => 4,
            ],
            'xaxis' => [
                'type' => 'category',
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                [
                    'title' => [
                        'text' => 'Receita (R$)',
                    ],
                    'labels' => [
                        'style' => [
                            'fontFamily' => 'inherit',
                        ],
                        'formatter' => "function(val) { return 'R$ ' + val.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.') }",
                    ],
                ],
                [
                    'opposite' => true,
                    'title' => [
                        'text' => 'Quantidade de Vendas',
                    ],
                    'labels' => [
                        'style' => [
                            'fontFamily' => 'inherit',
                        ],
                    ],
                ],
            ],
            'colors' => ['#10b981', '#3b82f6'],
            'legend' => [
                'position' => 'top',
                'fontFamily' => 'inherit',
            ],
            'tooltip' => [
                'enabled' => true,
                'shared' => true,
                'intersect' => false,
            ],
        ];
    }
}
