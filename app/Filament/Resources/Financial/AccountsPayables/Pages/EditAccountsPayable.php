<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsPayables\Pages;

use App\Filament\Resources\Financial\AccountsPayables\AccountsPayableResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditAccountsPayable extends EditRecord
{
    protected static string $resource = AccountsPayableResource::class;

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Conta a pagar atualizada com sucesso';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Excluir Conta a Pagar')
                ->modalDescription('Tem certeza que deseja excluir esta conta a pagar? Esta ação não pode ser desfeita.')
                ->modalSubmitActionLabel('Sim, excluir')
                ->successNotificationTitle('Conta a pagar excluída com sucesso'),
        ];
    }
}
