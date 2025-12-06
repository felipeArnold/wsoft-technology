<?php

declare(strict_types=1);

namespace App\Filament\Resources\Stock\StockInventories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class StockInventoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference')
                    ->label('Referência')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),

                TextColumn::make('inventory_date')
                    ->label('Data do Inventário')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Rascunho',
                        'in_progress' => 'Em Andamento',
                        'completed' => 'Concluído',
                        'cancelled' => 'Cancelado',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('items_count')
                    ->label('Itens')
                    ->counts('items')
                    ->numeric(0)
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('createdBy.name')
                    ->label('Criado Por')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('started_at')
                    ->label('Iniciado Em')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('completed_at')
                    ->label('Concluído Em')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Criado Em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Rascunho',
                        'in_progress' => 'Em Andamento',
                        'completed' => 'Concluído',
                        'cancelled' => 'Cancelado',
                    ])
                    ->multiple(),

                Tables\Filters\Filter::make('inventory_date')
                    ->form([
                        Forms\Components\DatePicker::make('date_from')
                            ->label('De'),
                        Forms\Components\DatePicker::make('date_until')
                            ->label('Até'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['date_from'], fn ($q) => $q->whereDate('inventory_date', '>=', $data['date_from']))
                            ->when($data['date_until'], fn ($q) => $q->whereDate('inventory_date', '<=', $data['date_until']));
                    }),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->emptyStateIcon('heroicon-o-inbox')
            ->emptyStateHeading('Nenhum inventário de estoque encontrado')
            ->emptyStateDescription('Crie um novo inventário para começar a gerenciar seu estoque.')
            ->emptyStateActions([
                CreateAction::make()
                    ->icon('heroicon-s-plus')
                    ->label('Nova Movimentação')
            ])
            ->paginated([10, 25, 50, 100]);
    }
}
