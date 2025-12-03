<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Funnels\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class FunnelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                ColorColumn::make('color')
                    ->label('Cor'),
                TextColumn::make('stages.name')
                    ->label('Etapas')
                    ->badge()
                    ->separator(',')
                    ->placeholder('Nenhuma etapa'),
                TextColumn::make('teams_count')
                    ->label('Equipes')
                    ->counts('teams')
                    ->sortable()
                    ->alignCenter(),
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
                        1 => 'Ativo',
                        0 => 'Inativo',
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
            ->emptyStateIcon('heroicon-o-funnel')
            ->emptyStateHeading('Nenhum funil encontrado')
            ->emptyStateDescription('Crie um novo funil para começar a gerenciar suas etapas.')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Criar Funil')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Criar Novo Funil'),
            ]);
    }
}
