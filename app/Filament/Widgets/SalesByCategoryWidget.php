<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class SalesByCategoryWidget extends ApexChartWidget
{
    protected static ?string $heading = 'Vendas por Categoria de Produto';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();

        $query = DB::table('sale_items')
            ->select([
                'categories.name as category_name',
                DB::raw('SUM(sale_items.quantity) as total_quantity'),
                DB::raw('SUM(sale_items.total) as total_revenue'),
            ])
            ->join('products', 'sale_items.product_id', '=', 'products.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id');

        if ($tenant) {
            $query->where('sale_items.tenant_id', $tenant->id);
        }

        $categories = $query
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_revenue')
            ->limit(10)
            ->get();

        if ($categories->isEmpty()) {
            $categoryNames = ['Nenhuma venda'];
            $quantities = [0];
            $revenues = [0];
        } else {
            $categoryNames = $categories->pluck('category_name')->map(function ($name) {
                return $name ?? 'Sem Categoria';
            })->toArray();

            $quantities = $categories->pluck('total_quantity')->map(fn ($value) => (float) $value)->toArray();
            $revenues = $categories->pluck('total_revenue')->map(fn ($value) => (float) $value)->toArray();
        }

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 400,
            ],
            'series' => $revenues,
            'labels' => $categoryNames,
            'colors' => ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#06b6d4', '#84cc16', '#f97316', '#6366f1'],
            'legend' => [
                'position' => 'bottom',
                'fontFamily' => 'inherit',
            ],
            'plotOptions' => [
                'pie' => [
                    'donut' => [
                        'size' => '60%',
                        'labels' => [
                            'show' => true,
                            'total' => [
                                'show' => true,
                                'label' => 'Total',
                                'formatter' => "function(w) {
                                    const total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    return 'R$ ' + total.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                }",
                            ],
                        ],
                    ],
                ],
            ],
            'dataLabels' => [
                'enabled' => true,
                'formatter' => "function(val) { return val.toFixed(1) + '%' }",
            ],
            'tooltip' => [
                'enabled' => true,
                'y' => [
                    'formatter' => 'function(val, { seriesIndex, w }) {
                        const quantities = '.json_encode($quantities).";
                        return 'R$ ' + val.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ' (' + quantities[seriesIndex] + ' un)';
                    }",
                ],
            ],
        ];
    }
}
