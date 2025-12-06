<?php

declare(strict_types=1);

namespace App\Filament\Resources\Stock\StockMovements\Tables;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class StockMovementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->label('Produto')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('product.sku')
                    ->label('SKU')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'in' => 'success',
                        'out' => 'danger',
                        'adjustment' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'in' => 'Entrada',
                        'out' => 'Saída',
                        'adjustment' => 'Ajuste',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('quantity')
                    ->label('Quantidade')
                    ->numeric(0)
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('stock_before')
                    ->label('Estoque Anterior')
                    ->numeric(0)
                    ->alignCenter()
                    ->toggleable(),

                TextColumn::make('stock_after')
                    ->label('Estoque Após')
                    ->numeric(0)
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('unit_cost')
                    ->label('Custo Unit.')
                    ->money('BRL')
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('reason')
                    ->label('Motivo')
                    ->searchable()
                    ->toggleable()
                    ->wrap(),

                TextColumn::make('user.name')
                    ->label('Usuário')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'in' => 'Entrada',
                        'out' => 'Saída',
                        'adjustment' => 'Ajuste',
                    ]),

                Tables\Filters\SelectFilter::make('product_id')
                    ->label('Produto')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('De'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Até'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], fn ($q) => $q->whereDate('created_at', '>=', $data['created_from']))
                            ->when($data['created_until'], fn ($q) => $q->whereDate('created_at', '<=', $data['created_until']));
                    }),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->emptyStateIcon('heroicon-o-clipboard-document-list')
            ->emptyStateHeading('Nenhuma movimentação de estoque encontrada')
            ->emptyStateDescription('Crie novas movimentações de estoque para que elas apareçam aqui.')
            ->emptyStateActions([
                CreateAction::make()
                    ->icon('heroicon-s-plus')
                    ->label('Nova Movimentação')
            ])
            ->paginated([10, 25, 50, 100]);
    }
}
