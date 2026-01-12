<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Budegets\Pages;

use App\Filament\Resources\Services\Budegets\BudegetResource;
use App\Filament\Resources\Services\ServiceOrders\Actions\ConvertBudgetToServiceOrderAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\CreateAccountReceivableAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\DownloadServiceOrderPdfAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\SendServiceOrderEmailAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewBudeget extends ViewRecord
{
    protected static string $resource = BudegetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Editar')
                ->icon('heroicon-o-pencil'),
            ConvertBudgetToServiceOrderAction::make(),
            ActionGroup::make([
                CreateAccountReceivableAction::make()->color('default')->label('Criar Conta a Receber'),
                SendServiceOrderEmailAction::make()->color('default')->label('Enviar E-mail'),
                DownloadServiceOrderPdfAction::make()->color('default')->label('Baixar PDF'),
                DeleteAction::make()
                    ->label('Excluir Orçamento')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->modalHeading('Excluir Orçamento')
                    ->modalDescription('Tem certeza que deseja excluir este orçamento? Esta ação não pode ser desfeita.')
                    ->modalSubmitActionLabel('Sim, excluir')
                    ->successNotificationTitle('Orçamento #'.$this->record->number.' excluído com sucesso'),
            ])
                ->label('Ações')
                ->button()
                ->iconPosition('after')
                ->color('gray'),

        ];
    }
}
