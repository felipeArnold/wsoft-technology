<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class StockValueByCategoryWidget extends ApexChartWidget
{
    protected static ?string $heading = 'Valor de Estoque por Categoria';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();

        $query = DB::table('products')
            ->select([
                'categories.name as category_name',
                DB::raw('SUM(products.stock * products.price_cost) as total_value'),
                DB::raw('SUM(products.stock) as total_quantity'),
            ])
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.stock', '>', 0);

        if ($tenant) {
            $query->where('products.tenant_id', $tenant->id);
        }

        $categories = $query
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_value')
            ->limit(10)
            ->get();

        if ($categories->isEmpty()) {
            $categoryNames = ['Nenhuma categoria'];
            $values = [0];
            $quantities = [0];
        } else {
            $categoryNames = $categories->pluck('category_name')->map(function ($name) {
                return $name ?? 'Sem Categoria';
            })->toArray();

            $values = $categories->pluck('total_value')->map(fn ($value) => (float) $value)->toArray();
            $quantities = $categories->pluck('total_quantity')->map(fn ($value) => (int) $value)->toArray();
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 350,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'Valor em Estoque (R$)',
                    'data' => $values,
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => true,
                    'borderRadius' => 4,
                    'dataLabels' => [
                        'position' => 'top',
                    ],
                ],
            ],
            'dataLabels' => [
                'enabled' => true,
                'formatter' => "function(val) { return 'R$ ' + val.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.') }",
                'offsetX' => 0,
                'style' => [
                    'fontSize' => '12px',
                    'colors' => ['#304758'],
                ],
            ],
            'xaxis' => [
                'categories' => $categoryNames,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'title' => [
                    'text' => 'Categorias',
                ],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#3b82f6'],
            'tooltip' => [
                'enabled' => true,
                'y' => [
                    'formatter' => "function(val, { seriesIndex, dataPointIndex, w }) {
                        const quantities = " . json_encode($quantities) . ";
                        return 'R$ ' + val.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ' (' + quantities[dataPointIndex] + ' un)'
                    }",
                ],
            ],
        ];
    }
}
