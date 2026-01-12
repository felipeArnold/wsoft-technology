<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Budegets\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\ConvertBudgetToServiceOrderAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\CreateAccountReceivableAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\CreateAccountReceivableBulkAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\DownloadServiceOrderPdfAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\SendServiceOrderEmailAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\UpdatePriorityBulkAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\UpdateResponsibleBulkAction;
use App\Models\ServiceOrder;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

final class BudegetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(ServiceOrder::getTableColumns())
            ->filters([
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
            ->groups([
                Group::make('Priority')->collapsible(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                ConvertBudgetToServiceOrderAction::make(),
                ActionGroup::make([
                    DownloadServiceOrderPdfAction::make()->color('default')->label('Baixar PDF'),
                    CreateAccountReceivableAction::make()->color('default')->label('Criar Conta a Receber'),
                    SendServiceOrderEmailAction::make()->color('default')->label('Enviar E-mail'),
                    DeleteBulkAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    UpdatePriorityBulkAction::make(),
                    UpdateResponsibleBulkAction::make(),
                    CreateAccountReceivableBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-rectangle-stack')
            ->emptyStateHeading('Nenhum orçamento encontrado')
            ->emptyStateDescription('Crie seu primeiro orçamento para começar.')
            ->emptyStateActions([
                CreateAction::make()->label('Novo Orçamento')->icon('heroicon-o-plus'),
            ])
            ->defaultPaginationPageOption(100)
            ->paginationPageOptions([10, 25, 50, 100, 250, 'all']);
    }
}
