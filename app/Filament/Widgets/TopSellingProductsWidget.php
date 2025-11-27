<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

final class TopSellingProductsWidget extends BaseWidget
{
    protected static ?string $heading = 'Produtos Mais Vendidos';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 5;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->select([
                        'products.*',
                        DB::raw('COALESCE(SUM(sale_items.quantity), 0) as total_sold'),
                        DB::raw('COALESCE(SUM(sale_items.total), 0) as total_revenue'),
                    ])
                    ->leftJoin('sale_items', 'products.id', '=', 'sale_items.product_id')
                    ->groupBy('products.id')
                    ->having('total_sold', '>', 0)
                    ->orderByDesc('total_sold')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Produto')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoria')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_sold')
                    ->label('Quantidade Vendida')
                    ->numeric(0)
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('total_revenue')
                    ->label('Receita Total')
                    ->money('BRL')
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Estoque Atual')
                    ->numeric(0)
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    }),

                Tables\Columns\TextColumn::make('price_sale')
                    ->label('Preço de Venda')
                    ->money('BRL')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'name')
                    ->preload(),
            ])
            ->defaultSort('total_sold', 'desc')
            ->paginated([10, 25, 50]);
    }
}
