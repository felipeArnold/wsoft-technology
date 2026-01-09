<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\ServiceOrder;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class ServiceOrdersByStatusChart extends ApexChartWidget
{
    protected static ?string $heading = 'Ordens de Serviço por Status';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 1;

    protected ?string $pollingInterval = null;

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();

        $query = ServiceOrder::query();

        if ($tenant) {
            $query->where('tenant_id', $tenant->id);
        }

        // Contar por status
        $statusCounts = $query
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Se não houver dados, retornar vazio
        if ($statusCounts->isEmpty()) {
            return [
                'chart' => [
                    'type' => 'donut',
                    'height' => 300,
                ],
                'series' => [1],
                'labels' => ['Nenhuma ordem de serviço'],
                'colors' => ['#e5e7eb'],
                'legend' => [
                    'position' => 'bottom',
                    'fontFamily' => 'inherit',
                ],
            ];
        }

        $series = [];
        $labels = [];
        $colors = [];

        foreach ($statusCounts as $statusCount) {
            $series[] = (int) $statusCount->total;
            // Status is already cast to enum by Eloquent, so we can use it directly
            $status = $statusCount->status;
            $labels[] = $status->getLabel();
            $calendarColors = $status->getCalendarColor();
            $colors[] = $calendarColors['bg'];
        }

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'series' => $series,
            'labels' => $labels,
            'colors' => $colors,
            'legend' => [
                'position' => 'bottom',
                'fontFamily' => 'inherit',
            ],
            'plotOptions' => [
                'pie' => [
                    'donut' => [
                        'labels' => [
                            'show' => true,
                            'total' => [
                                'show' => true,
                                'label' => 'Total',
                                'fontFamily' => 'inherit',
                            ],
                        ],
                    ],
                ],
            ],
            'dataLabels' => [
                'enabled' => true,
            ],
            'tooltip' => [
                'enabled' => true,
            ],
        ];
    }
}
