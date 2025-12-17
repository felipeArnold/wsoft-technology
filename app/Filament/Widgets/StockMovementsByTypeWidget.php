<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\StockMovement;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class StockMovementsByTypeWidget extends ApexChartWidget
{
    protected static ?string $heading = 'Movimentações de Estoque (Últimos 30 dias)';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();

        $movements = StockMovement::query()
            ->select([
                DB::raw('DATE(created_at) as date'),
                'type',
                DB::raw('SUM(quantity) as total_quantity'),
            ])
            ->when($tenant, fn ($query) => $query->where('tenant_id', $tenant->id))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date', 'type')
            ->orderBy('date')
            ->get();

        $dates = collect();
        for ($i = 29; $i >= 0; $i--) {
            $dates->push(now()->subDays($i)->format('Y-m-d'));
        }

        $entradas = [];
        $saidas = [];
        $labels = [];

        foreach ($dates as $date) {
            $labels[] = \Carbon\Carbon::parse($date)->format('d/m');

            $entrada = $movements->where('date', $date)->where('type', 'entrada')->first();
            $saida = $movements->where('date', $date)->where('type', 'saida')->first();

            $entradas[] = $entrada ? (float) $entrada->total_quantity : 0;
            $saidas[] = $saida ? (float) $saida->total_quantity : 0;
        }

        return [
            'chart' => [
                'type' => 'area',
                'height' => 350,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'Entradas',
                    'data' => $entradas,
                ],
                [
                    'name' => 'Saídas',
                    'data' => $saidas,
                ],
            ],
            'xaxis' => [
                'categories' => $labels,
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
            'dataLabels' => [
                'enabled' => false,
            ],
            'stroke' => [
                'curve' => 'smooth',
                'width' => 2,
            ],
            'colors' => ['#10b981', '#ef4444'],
            'fill' => [
                'type' => 'gradient',
                'gradient' => [
                    'shadeIntensity' => 1,
                    'opacityFrom' => 0.7,
                    'opacityTo' => 0.3,
                ],
            ],
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
