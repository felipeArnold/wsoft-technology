<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Pages;

use App\Filament\Resources\Services\ServiceOrders\Actions\CreateAccountReceivableAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\DownloadServiceOrderPdfAction;
use App\Filament\Resources\Services\ServiceOrders\Actions\SendServiceOrderEmailAction;
use App\Filament\Resources\Services\ServiceOrders\ServiceOrderResource;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewServiceOrder extends ViewRecord
{
    protected static string $resource = ServiceOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DownloadServiceOrderPdfAction::make(),
            EditAction::make()
                ->label('Editar')
                ->icon('heroicon-o-pencil')
                ->modalWidth('2xl'),
            ActionGroup::make([
                CreateAccountReceivableAction::make()->color('success')->label('Criar Conta a Receber'),
                SendServiceOrderEmailAction::make()->color('primary')->label('Enviar E-mail'),
                DeleteAction::make()
                    ->label('Excluir Ordem')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->modalHeading('Excluir Ordem de Serviço')
                    ->modalDescription('Tem certeza que deseja excluir esta ordem de serviço? Esta ação não pode ser desfeita.')
                    ->modalSubmitActionLabel('Sim, excluir')
                    ->successNotificationTitle('Ordem de serviço #'.$this->record->number.' excluída com sucesso'),
            ])
                ->label('Ações')
                ->button()
                ->color('gray'),

        ];
    }
}
