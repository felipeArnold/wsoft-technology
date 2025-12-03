<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Teams\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class TeamsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('users.avatar')
                    ->label('Membros')
                    ->circular()
                    ->stacked()
                    ->limit(5)
                    ->limitedRemainingText(),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(50)
                    ->placeholder('Sem descrição')
                    ->searchable()
                    ->toggleable(),
                IconColumn::make('active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
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
                SelectFilter::make('active')
                    ->label('Status')
                    ->options([
                        1 => 'Ativa',
                        0 => 'Inativa',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated(false)
            ->emptyStateIcon('heroicon-o-arrow-up-circle')
            ->emptyStateHeading('Nenhuma equipe encontrada')
            ->emptyStateDescription('Crie uma nova equipe para começar a gerenciar suas equipes.')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Criar Equipe'),
            ]);
    }
}
