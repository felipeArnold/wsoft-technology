<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\LossReasons\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Clusters\Settings\CRM\LossReasons\LossReasonResource;
use Exception;
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

final class LossReasonsTable
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
                IconColumn::make('is_default')
                    ->label('Padrão')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->sortable(),
                IconColumn::make('active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('active')
                    ->label('Status')
                    ->options([
                        1 => 'Active',
                        0 => 'Inactive',
                    ]),
                SelectFilter::make('is_default')
                    ->label('Type')
                    ->options([
                        1 => 'Default',
                        0 => 'Custom',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                    ->disabled(fn ($record) => $record->is_default === true),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                if ($record->is_default) {
                                    throw new Exception('Default loss reasons cannot be deleted.');
                                }
                            }
                        }),
                ]),
                FilamentExportBulkAction::make('export')->label('Export'),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated(false)
            ->emptyStateIcon('heroicon-o-x-circle')
            ->emptyStateHeading('No loss reasons found')
            ->emptyStateDescription('Create a new loss reason to start tracking lead losses.')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Create Loss Reason')
                    ->url(fn (): string => LossReasonResource::getUrl('create')),
            ]);
    }
}
