<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Products\RelationManagers;

use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class StockMovementsRelationManager extends RelationManager
{
    protected static string $relationship = 'stockMovements';

    protected static ?string $title = 'Histórico de Movimentações';

    protected static ?string $recordTitleAttribute = 'id';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->modifyQueryUsing(fn ($query) => $query->with(['user']))
            ->columns([
                TextColumn::make('created_at')
                    ->label('Data/Hora')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

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
                    ->badge()
                    ->color(fn ($record): string => match ($record->type) {
                        'in' => 'success',
                        'out' => 'danger',
                        'adjustment' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('stock_before')
                    ->label('Estoque Anterior')
                    ->numeric(0)
                    ->alignCenter(),

                TextColumn::make('stock_after')
                    ->label('Estoque Após')
                    ->numeric(0)
                    ->alignCenter()
                    ->weight('bold'),

                TextColumn::make('unit_cost')
                    ->label('Custo Unit.')
                    ->money('BRL')
                    ->toggleable()
                    ->placeholder('-'),

                TextColumn::make('reason')
                    ->label('Motivo')
                    ->searchable()
                    ->wrap()
                    ->placeholder('-'),

                TextColumn::make('user.name')
                    ->label('Usuário')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('notes')
                    ->label('Observações')
                    ->limit(50)
                    ->toggleable()
                    ->placeholder('-')
                    ->wrap(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'in' => 'Entrada',
                        'out' => 'Saída',
                        'adjustment' => 'Ajuste',
                    ]),
            ])
            ->headerActions([
                // Não permitimos criar movimentações diretamente, apenas via actions
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([
                // Não permitimos deletar movimentações
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }
}
