<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Product;
use DB;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

final class StockOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static bool $isLazy = true;

    protected ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $tenant = Filament::getTenant();

        $query = Product::query();

        if ($tenant) {
            $query->where('tenant_id', $tenant->id);
        }

        $totalProducts = $query->count();
        $totalStockValue = $query->sum(DB::raw('stock * price_cost'));
        $outOfStock = $query->where('stock', 0)->count();
        $lowStock = $query->whereNotNull('stock_alert')
            ->whereRaw('stock <= stock_alert')
            ->where('stock', '>', 0)
            ->count();

        $productsWithStock = $query->where('stock', '>', 0)->count();
        $averageStockValue = $productsWithStock > 0
            ? $totalStockValue / $productsWithStock
            : 0;

        return [
            Stat::make('Valor Total em Estoque', 'R$ '.number_format((float) $totalStockValue, 2, ',', '.'))
                ->description('Baseado no custo dos produtos')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Produtos sem Estoque', $outOfStock)
                ->description($totalProducts > 0 ? round(($outOfStock / $totalProducts) * 100, 1).'% do total' : '0%')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color('danger'),

            Stat::make('Produtos com Estoque Baixo', $lowStock)
                ->description('Abaixo do nível mínimo')
                ->descriptionIcon('heroicon-o-arrow-trending-down')
                ->color('warning'),

            Stat::make('Valor Médio por Produto', 'R$ '.number_format((float) $averageStockValue, 2, ',', '.'))
                ->description('Produtos em estoque')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('info'),
        ];
    }
}
