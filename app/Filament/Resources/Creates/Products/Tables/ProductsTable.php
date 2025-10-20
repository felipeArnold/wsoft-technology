<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Products\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

final class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome do Produto')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
                TextColumn::make('person.name')
                    ->label('Fornecedor')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
                TextColumn::make('price_cost')
                    ->label('Custo')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('price_sale')
                    ->label('Venda')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('net_profit')
                    ->label('Lucro')
                    ->money('BRL')
                    ->sortable()
                    ->color(fn ($state): string => $state > 0 ? 'success' : ($state < 0 ? 'danger' : 'gray')),
                TextColumn::make('stock')
                    ->label('Estoque')
                    ->numeric()
                    ->sortable()
                    ->color(fn ($record): string => $record->stock <= $record->stock_alert ? 'danger' : 'success'),
                TextColumn::make('stock_alert')
                    ->label('Alerta')
                    ->numeric()
                    ->sortable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('person')
                    ->label('Fornecedor')
                    ->relationship('person', 'name')
                    ->searchable()
                    ->preload(),
                TernaryFilter::make('low_stock')
                    ->label('Estoque Baixo')
                    ->queries(
                        true: fn ($query) => $query->whereRaw('stock <= stock_alert'),
                        false: fn ($query) => $query->whereRaw('stock > stock_alert'),
                    ),
                TernaryFilter::make('profitable')
                    ->label('Lucrativo')
                    ->queries(
                        true: fn ($query) => $query->whereRaw('net_profit > 0'),
                        false: fn ($query) => $query->whereRaw('net_profit <= 0'),
                    ),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Ver'),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-inbox')
            ->emptyStateHeading('Nenhum produto encontrado')
            ->emptyStateDescription('Crie seu primeiro produto para começar a gerenciar seu inventário.')
            ->defaultPaginationPageOption(50);
    }
}
