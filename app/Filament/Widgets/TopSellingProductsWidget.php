<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class TopSellingProductsWidget extends ApexChartWidget
{
    protected static ?string $heading = 'Produtos Mais Vendidos';


    protected static ?int $sort = 4;

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();

        $query = DB::table('products')
            ->select([
                'products.id',
                'products.name',
                DB::raw('COALESCE(SUM(sale_items.quantity), 0) as total_sold'),
                DB::raw('COALESCE(SUM(sale_items.total), 0) as total_revenue'),
            ])
            ->leftJoin('sale_items', 'products.id', '=', 'sale_items.product_id');

        if ($tenant) {
            $query->where('products.tenant_id', $tenant->id);
        }

        $products = $query
            ->groupBy('products.id', 'products.name')
            ->having('total_sold', '>', 0)
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        // Se não houver dados, retornar arrays vazios
        if ($products->isEmpty()) {
            $productNames = ['Nenhum produto vendido'];
            $quantitiesSold = [0];
            $revenues = [0];
        } else {
            $productNames = $products->pluck('name')->map(function ($name) {
                return mb_strlen($name) > 30 ? mb_substr($name, 0, 27).'...' : $name;
            })->toArray();

            $quantitiesSold = $products->pluck('total_sold')->map(fn ($value) => (float) $value)->toArray();
            $revenues = $products->pluck('total_revenue')->map(fn ($value) => (float) $value)->toArray();
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 350,
                'stacked' => true,
                'toolbar' => [
                    'show' => true,
                ],
                'zoom' => [
                    'enabled' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'Quantidade Vendida',
                    'data' => $quantitiesSold,
                ],
                [
                    'name' => 'Receita (R$)',
                    'data' => $revenues,
                ],
            ],
            'responsive' => [
                [
                    'breakpoint' => 480,
                    'options' => [
                        'legend' => [
                            'position' => 'bottom',
                            'offsetX' => -10,
                            'offsetY' => 0,
                        ],
                    ],
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => false,
                    'borderRadius' => 10,
                    'borderRadiusApplication' => 'end',
                    'borderRadiusWhenStacked' => 'last',
                    'dataLabels' => [
                        'total' => [
                            'enabled' => true,
                            'style' => [
                                'fontSize' => '13px',
                                'fontWeight' => 900,
                            ],
                        ],
                    ],
                ],
            ],
            'xaxis' => [
                'type' => 'category',
                'categories' => $productNames,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'title' => [
                    'text' => 'Valores',
                ],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'legend' => [
                'position' => 'right',
                'offsetY' => 40,
                'fontFamily' => 'inherit',
            ],
            'fill' => [
                'opacity' => 1,
            ],
            'colors' => ['#10b981', '#3b82f6'],
            'dataLabels' => [
                'enabled' => false,
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
