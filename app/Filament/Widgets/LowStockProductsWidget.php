<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

final class LowStockProductsWidget extends BaseWidget
{
    protected static ?string $heading = 'Produtos com Estoque Baixo';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->with(['category', 'person'])
                    ->whereNotNull('stock_alert')
                    ->whereRaw('stock <= stock_alert')
                    ->where('stock_alert', '>', 0)
                    ->orderBy('stock', 'asc')
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

                Tables\Columns\TextColumn::make('stock')
                    ->label('Estoque Atual')
                    ->numeric(0)
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state <= 5 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    }),

                Tables\Columns\TextColumn::make('stock_alert')
                    ->label('Estoque Mínimo')
                    ->numeric(0)
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('difference')
                    ->label('Diferença')
                    ->getStateUsing(fn (Product $record): int => $record->stock - $record->stock_alert)
                    ->numeric(0)
                    ->alignCenter()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state < 0 => 'danger',
                        $state === 0 => 'warning',
                        default => 'success',
                    }),

                Tables\Columns\TextColumn::make('person.name')
                    ->label('Fornecedor')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('price_cost')
                    ->label('Custo')
                    ->money('BRL')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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

                Tables\Filters\SelectFilter::make('stock_status')
                    ->label('Status do Estoque')
                    ->options([
                        'out' => 'Sem Estoque',
                        'critical' => 'Crítico (≤5)',
                        'low' => 'Baixo (≤10)',
                    ])
                    ->query(function ($query, array $data): void {
                        if (filled($data['value'])) {
                            match ($data['value']) {
                                'out' => $query->where('stock', 0),
                                'critical' => $query->where('stock', '>', 0)->where('stock', '<=', 5),
                                'low' => $query->where('stock', '>', 5)->where('stock', '<=', 10),
                                default => null,
                            };
                        }
                    }),
            ])
            ->defaultSort('stock', 'asc')
            ->paginated([10, 25, 50]);
    }
}
