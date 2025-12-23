<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\StockMovement;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

final class RecentStockMovementsWidget extends BaseWidget
{
    protected static ?string $heading = 'Movimentações Recentes de Estoque';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                StockMovement::query()
                    ->with(['product', 'user'])
                    ->latest()
                    ->limit(15)
            )
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produto')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'entrada' => 'success',
                        'saida' => 'danger',
                        'ajuste' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Quantidade')
                    ->numeric(0)
                    ->alignCenter()
                    ->badge()
                    ->color(fn (StockMovement $record): string => match ($record->type) {
                        'entrada' => 'success',
                        'saida' => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn (int $state, StockMovement $record): string => ($record->type === 'entrada' ? '+' : ($record->type === 'saida' ? '-' : '')).$state
                    ),

                Tables\Columns\TextColumn::make('stock_before')
                    ->label('Estoque Anterior')
                    ->numeric(0)
                    ->alignCenter()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('stock_after')
                    ->label('Estoque Atual')
                    ->numeric(0)
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('reason')
                    ->label('Motivo')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuário')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'entrada' => 'Entrada',
                        'saida' => 'Saída',
                        'ajuste' => 'Ajuste',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }
}
