<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\ServiceOrder;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class ServiceOrdersCreationByDayChart extends ApexChartWidget
{
    protected static ?string $heading = 'Ordens Criadas - Últimos 7 Dias';

    protected static ?int $sort = 3;

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();
        $today = Date::now();
        $startDate = (clone $today)->subDays(6)->startOfDay();
        $endDate = (clone $today)->endOfDay();

        $query = ServiceOrder::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('date')
            ->orderBy('date');

        if ($tenant) {
            $query->where('tenant_id', $tenant->id);
        }

        $results = $query->get()->keyBy('date');

        $dates = [];
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = (clone $today)->subDays($i)->format('Y-m-d');
            $displayDate = (clone $today)->subDays($i)->format('d/m');

            $dates[] = $displayDate;
            $counts[] = (int) ($results->get($date)?->total ?? 0);
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'Ordens Criadas',
                    'data' => $counts,
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
                'title' => [
                    'text' => 'Quantidade',
                ],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 4,
                    'dataLabels' => [
                        'position' => 'top',
                    ],
                ],
            ],
            'dataLabels' => [
                'enabled' => true,
                'offsetY' => -20,
                'style' => [
                    'fontSize' => '12px',
                    'colors' => ['#304758'],
                ],
            ],
            'colors' => ['#1d4ed8'],
            'grid' => [
                'show' => true,
            ],
            'tooltip' => [
                'enabled' => true,
                'y' => [
                    'formatter' => null,
                ],
            ],
        ];
    }
}
