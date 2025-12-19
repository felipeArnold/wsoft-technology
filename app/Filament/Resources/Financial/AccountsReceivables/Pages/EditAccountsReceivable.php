<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsReceivables\Pages;

use App\Filament\Resources\Financial\AccountsReceivables\AccountsReceivableResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditAccountsReceivable extends EditRecord
{
    protected static string $resource = AccountsReceivableResource::class;

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Conta a receber atualizada com sucesso';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Excluir Conta a Receber')
                ->modalDescription('Tem certeza que deseja excluir esta conta a receber? Esta ação não pode ser desfeita.')
                ->modalSubmitActionLabel('Sim, excluir')
                ->successNotificationTitle('Conta a receber excluída com sucesso'),
        ];
    }
}
