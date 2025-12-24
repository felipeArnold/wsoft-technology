<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\ServiceOrder;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class ServiceOrdersCompletionTrend extends ApexChartWidget
{
    protected static ?string $heading = 'Conclusão de Ordens - Últimos 30 Dias';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 2;

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();
        $today = Date::now();
        $startDate = (clone $today)->subDays(29)->startOfDay();
        $endDate = (clone $today)->endOfDay();

        $query = ServiceOrder::query()
            ->where('status', 'completed')
            ->whereBetween('completion_date', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(completion_date) as date'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(total_value) as revenue')
            )
            ->groupBy('date')
            ->orderBy('date');

        if ($tenant) {
            $query->where('tenant_id', $tenant->id);
        }

        $results = $query->get()->keyBy('date');

        $dates = [];
        $completedCounts = [];
        $revenues = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = (clone $today)->subDays($i)->format('Y-m-d');
            $displayDate = (clone $today)->subDays($i)->format('d/m');

            $dates[] = $displayDate;
            $completedCounts[] = (int) ($results->get($date)?->total ?? 0);
            $revenues[] = (float) ($results->get($date)?->revenue ?? 0);
        }

        return [
            'chart' => [
                'type' => 'area',
                'height' => 300,
                'toolbar' => [
                    'show' => true,
                ],
                'zoom' => [
                    'enabled' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'Ordens Concluídas',
                    'data' => $completedCounts,
                ],
                [
                    'name' => 'Receita (R$)',
                    'data' => $revenues,
                ],
            ],
            'xaxis' => [
                'categories' => $dates,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                [
                    'title' => [
                        'text' => 'Quantidade',
                    ],
                    'labels' => [
                        'style' => [
                            'fontFamily' => 'inherit',
                        ],
                    ],
                ],
                [
                    'opposite' => true,
                    'title' => [
                        'text' => 'Receita (R$)',
                    ],
                    'labels' => [
                        'style' => [
                            'fontFamily' => 'inherit',
                        ],
                    ],
                ],
            ],
            'dataLabels' => [
                'enabled' => false,
            ],
            'stroke' => [
                'curve' => 'smooth',
                'width' => 2,
            ],
            'fill' => [
                'type' => 'gradient',
                'gradient' => [
                    'shadeIntensity' => 1,
                    'opacityFrom' => 0.7,
                    'opacityTo' => 0.3,
                    'stops' => [0, 90, 100],
                ],
            ],
            'colors' => ['#3b82f6', '#10b981'],
            'legend' => [
                'position' => 'top',
                'fontFamily' => 'inherit',
            ],
            'grid' => [
                'show' => true,
            ],
            'tooltip' => [
                'enabled' => true,
                'shared' => true,
                'intersect' => false,
            ],
        ];
    }
}
