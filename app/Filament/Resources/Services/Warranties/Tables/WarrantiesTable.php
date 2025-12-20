<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Warranties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class WarrantiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serviceOrder.number')
                    ->label('OS')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('person.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('warranty_type')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'order' => 'info',
                        'product' => 'warning',
                        'service' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'order' => 'Ordem de Serviço',
                        'product' => 'Produto',
                        'service' => 'Serviço',
                        default => $state,
                    }),

                TextColumn::make('start_date')
                    ->label('Início')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('Término')
                    ->date('d/m/Y')
                    ->sortable()
                    ->description(fn ($record) => $record->getDaysRemaining() > 0
                        ? $record->getDaysRemaining() . ' dias restantes'
                        : 'Expirada'
                    ),

                TextColumn::make('duration_days')
                    ->label('Duração')
                    ->suffix(' dias')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'expired' => 'danger',
                        'claimed' => 'warning',
                        'cancelled' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'Ativa',
                        'expired' => 'Expirada',
                        'claimed' => 'Acionada',
                        'cancelled' => 'Cancelada',
                        default => $state,
                    }),

                TextColumn::make('warrantyClaims_count')
                    ->label('Acionamentos')
                    ->counts('warrantyClaims')
                    ->badge()
                    ->color('warning')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Ativa',
                        'expired' => 'Expirada',
                        'claimed' => 'Acionada',
                        'cancelled' => 'Cancelada',
                    ])
                    ->multiple(),

                SelectFilter::make('warranty_type')
                    ->label('Tipo')
                    ->options([
                        'order' => 'Ordem de Serviço',
                        'product' => 'Produto',
                        'service' => 'Serviço',
                    ])
                    ->multiple(),

                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('end_date', 'asc');
    }
}
