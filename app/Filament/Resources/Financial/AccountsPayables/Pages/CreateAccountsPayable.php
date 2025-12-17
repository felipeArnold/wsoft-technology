<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsPayables\Pages;

use App\Filament\Resources\Financial\AccountsPayables\AccountsPayableResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateAccountsPayable extends CreateRecord
{
    protected static string $resource = AccountsPayableResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Conta a pagar criada com sucesso';
    }
}
