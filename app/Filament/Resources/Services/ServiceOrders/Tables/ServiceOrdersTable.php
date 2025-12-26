<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\CreateAccountReceivableAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\CreateAccountReceivableBulkAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\DownloadServiceOrderPdfAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\SendServiceOrderEmailAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\UpdatePriorityBulkAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\UpdateResponsibleBulkAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\UpdateStatusBulkAction;
use App\Models\ServiceOrder;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

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
                SelectFilter::make('categories')
                    ->label('Etiquetas')
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->multiple()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                ActionGroup::make([
                    DownloadServiceOrderPdfAction::make(),
                    CreateAccountReceivableAction::make()->color('success')->label('Criar Conta a Receber'),
                    SendServiceOrderEmailAction::make()->color('primary')->label('Enviar E-mail'),
                    DeleteBulkAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    UpdatePriorityBulkAction::make(),
                    UpdateStatusBulkAction::make(),
                    UpdateResponsibleBulkAction::make(),
                    CreateAccountReceivableBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-clipboard-document-list')
            ->emptyStateHeading('Nenhuma ordem de serviço encontrada')
            ->emptyStateDescription('Crie sua primeira ordem de serviço para começar a gerenciar os serviços.')
            ->emptyStateActions([
                CreateAction::make()->label('Nova OS')->icon('heroicon-o-plus'),
            ])
            ->defaultPaginationPageOption(100)
            ->paginationPageOptions([10, 25, 50, 100, 250, 'all']);
    }
}
