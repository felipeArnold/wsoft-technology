<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(50)
                    ->placeholder('Sem descrição')
                    ->toggleable(),
                TextColumn::make('price')
                    ->label('Preço')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('discount')
                    ->label('Desconto')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated(false)
            ->emptyStateIcon('heroicon-o-wrench-screwdriver')
            ->emptyStateHeading('Nenhum serviço encontrado')
            ->emptyStateDescription('Crie um novo serviço para começar a gerenciar seus serviços.')
            ->emptyStateActions([
                CreateAction::make()
                    ->label('Novo Serviço')
                    ->icon('heroicon-o-plus'),
            ]);
    }
}
