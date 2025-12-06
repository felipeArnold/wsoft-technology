<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Activities\Tables;

use App\Filament\Exports\ActivityExporter;
use App\Filament\Exports\ActivityExportExporter;
use App\Filament\Imports\ActivitiesImporter;
use App\Filament\Imports\ProductImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class ActivitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(40),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'call' => 'Ligação',
                        'meeting' => 'Reunião',
                        'email' => 'E-mail',
                        'task' => 'Tarefa',
                        'follow_up' => 'Follow-up',
                        'other' => 'Outro',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'call' => 'info',
                        'meeting' => 'warning',
                        'email' => 'gray',
                        'task' => 'primary',
                        'follow_up' => 'success',
                        'other' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'in_progress' => 'Em Andamento',
                        'completed' => 'Concluído',
                        'cancelled' => 'Cancelado',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'in_progress' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('priority')
                    ->label('Prioridade')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'low' => 'Baixa',
                        'medium' => 'Média',
                        'high' => 'Alta',
                        'urgent' => 'Urgente',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'low' => 'gray',
                        'medium' => 'info',
                        'high' => 'warning',
                        'urgent' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('person.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A')
                    ->toggleable(),
                TextColumn::make('assignedTo.name')
                    ->label('Responsável')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A')
                    ->toggleable(),
                TextColumn::make('due_date')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->sortable()
                    ->color(fn ($record): string => $record->due_date && $record->due_date->isPast() && $record->status !== 'completed' ? 'danger' : 'gray')
                    ->placeholder('N/A'),
                TextColumn::make('categories.name')
                    ->label('Etiquetas')
                    ->badge()
                    ->separator(',')
                    ->searchable()
                    ->toggleable(),
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
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pendente',
                        'in_progress' => 'Em Andamento',
                        'completed' => 'Concluído',
                        'cancelled' => 'Cancelado',
                    ]),
                SelectFilter::make('priority')
                    ->label('Prioridade')
                    ->options([
                        'low' => 'Baixa',
                        'medium' => 'Média',
                        'high' => 'Alta',
                        'urgent' => 'Urgente',
                    ]),
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'call' => 'Ligação',
                        'meeting' => 'Reunião',
                        'email' => 'E-mail',
                        'task' => 'Tarefa',
                        'follow_up' => 'Follow-up',
                        'other' => 'Outro',
                    ]),
                SelectFilter::make('person')
                    ->label('Cliente')
                    ->relationship('person', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('assigned_to')
                    ->label('Responsável')
                    ->relationship('assignedTo', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('categories')
                    ->label('Etiquetas')
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->multiple()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    ExportAction::make()
                        ->icon(Heroicon::OutlinedArrowDownTray)
                        ->exporter(ActivityExporter::class)
                        ->label('Exportar'),
                    DeleteBulkAction::make(),
                ]),
            ])
            ->striped()
            ->defaultSort('due_date', 'asc')
            ->emptyStateIcon('heroicon-o-clipboard-document-check')
            ->emptyStateHeading('Nenhuma atividade encontrada')
            ->emptyStateDescription('Crie sua primeira atividade para começar a gerenciar suas tarefas e compromissos.')
            ->defaultPaginationPageOption(25);
    }
}
