<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Models\ServiceOrder;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

final class ServiceOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(ServiceOrder::getTableColumns())
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Rascunho',
                        'in_progress' => 'Em Andamento',
                        'completed' => 'Concluída',
                        'cancelled' => 'Cancelada',
                    ]),
                SelectFilter::make('priority')
                    ->label('Prioridade')
                    ->options([
                        'low' => 'Baixa',
                        'medium' => 'Média',
                        'high' => 'Alta',
                        'urgent' => 'Urgente',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    Action::make('update_priority')
                        ->label('Atualizar Prioridade')
                        ->icon('heroicon-o-pencil-square')
                        ->modalWidth('md')
                        ->requiresConfirmation()
                        ->color('warning')
                        ->accessSelectedRecords()
                        ->form([
                            Select::make('priority')
                                ->label('Prioridade')
                                ->options([
                                    'low' => 'Baixa',
                                    'medium' => 'Média',
                                    'high' => 'Alta',
                                    'urgent' => 'Urgente',
                                ])
                                ->native(false)
                                ->required(),
                        ])
                        ->action(function (array $data, Collection $records): void {
                            $records->each(function (ServiceOrder $record) use ($data): void {
                                $record->update([
                                    'priority' => $data['priority'],
                                ]);
                            });

                            Notification::make()
                                ->title('Prioridade atualizada com sucesso')
                                ->success()
                                ->body('A prioridade das ordens de serviço selecionadas foi atualizada.')
                                ->send();
                        }),
                    Action::make('update_status')
                        ->label('Atualizar Status')
                        ->icon('heroicon-o-arrow-path')
                        ->modalWidth('md')
                        ->requiresConfirmation()
                        ->color('info')
                        ->accessSelectedRecords()
                        ->form([
                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'draft' => 'Rascunho',
                                    'in_progress' => 'Em Andamento',
                                    'completed' => 'Concluída',
                                    'cancelled' => 'Cancelada',
                                ])
                                ->native(false)
                                ->required(),
                        ])
                        ->action(function (array $data, Collection $records): void {
                            $records->each(function (ServiceOrder $record) use ($data): void {
                                $record->update([
                                    'status' => $data['status'],
                                ]);
                            });

                            Notification::make()
                                ->title('Status atualizado com sucesso')
                                ->success()
                                ->body('O status das ordens de serviço selecionadas foi atualizado.')
                                ->send();
                        }),
                    Action::make('update_responsible')
                        ->label('Atualizar Responsável')
                        ->icon('heroicon-o-user')
                        ->modalWidth('md')
                        ->requiresConfirmation()
                        ->color('success')
                        ->accessSelectedRecords()
                        ->form([
                            Select::make('user_id')
                                ->label('Responsável Técnico')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),
                        ])
                        ->action(function (array $data, Collection $records): void {
                            $records->each(function (ServiceOrder $record) use ($data): void {
                                $record->update([
                                    'user_id' => $data['user_id'],
                                ]);
                            });

                            Notification::make()
                                ->title('Responsável atualizado com sucesso')
                                ->success()
                                ->body('O responsável técnico das ordens de serviço selecionadas foi atualizado.')
                                ->send();
                        }),
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-clipboard-document-list')
            ->emptyStateHeading('Nenhuma ordem de serviço encontrada')
            ->emptyStateDescription('Crie sua primeira ordem de serviço para começar a gerenciar os serviços.');
    }
}
