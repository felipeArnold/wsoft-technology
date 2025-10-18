<?php

namespace App\Filament\Resources\Financial\AccountsPayables\Pages;

use App\Filament\Resources\Financial\AccountsPayables\AccountsPayableResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAccountsPayable extends EditRecord
{
    protected static string $resource = AccountsPayableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
