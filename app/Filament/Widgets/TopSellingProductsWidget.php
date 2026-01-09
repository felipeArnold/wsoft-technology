<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Facades\Filament;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class TopSellingProductsWidget extends ApexChartWidget
{
    protected static ?string $heading = 'Produtos Mais Vendidos';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    protected ?string $pollingInterval = null;

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();

        $products = Product::query()
            ->withSum('saleItems', 'quantity')
            ->withSum('saleItems', 'total')
            ->when($tenant, fn ($query) => $query->where('tenant_id', $tenant->id))
            ->whereRelation('saleItems', 'quantity', '>', 0)
            ->orderByDesc('sale_items_sum_quantity')
            ->limit(10)
            ->get();

        // Se não houver dados, retornar arrays vazios
        if ($products->isEmpty()) {
            $productNames = ['Nenhum produto vendido'];
            $quantitiesSold = [0];
            $revenues = [0];
        } else {
            $productNames = $products->map(function (Product $product) {
                $name = $product->name;

                return mb_strlen($name) > 30 ? mb_substr($name, 0, 27).'...' : $name;
            })->toArray();

            $quantitiesSold = $products->map(fn (Product $product) => (float) $product->sale_items_sum_quantity)->toArray();
            $revenues = $products->map(fn (Product $product) => (float) $product->sale_items_sum_total)->toArray();
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
