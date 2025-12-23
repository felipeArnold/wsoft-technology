<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Vehicles\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class VehiclesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('plate')
                    ->label('Placa')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),
                TextColumn::make('person.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('brand')
                    ->label('Marca')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('model')
                    ->label('Modelo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('year')
                    ->label('Ano')
                    ->sortable()
                    ->placeholder('N/A'),
                TextColumn::make('color')
                    ->label('Cor')
                    ->searchable()
                    ->placeholder('N/A'),
                TextColumn::make('chassis')
                    ->label('Chassi')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('renavam')
                    ->label('Renavam')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Cadastrado em')
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
                    ->label('Cliente')
                    ->relationship('person', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('brand')
                    ->label('Marca')
                    ->options(fn () => \App\Models\Vehicle::query()->distinct()->pluck('brand', 'brand'))
                    ->searchable(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-truck')
            ->emptyStateHeading('Nenhum veículo encontrado')
            ->emptyStateDescription('Cadastre o primeiro veículo para começar.')
            ->emptyStateActions([
                CreateAction::make()
                    ->icon('heroicon-s-plus')
                    ->label('Novo Veículo'),
            ])
            ->defaultPaginationPageOption(50);
    }
}
