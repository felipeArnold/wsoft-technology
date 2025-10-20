<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsPayables\Pages;

use App\Filament\Resources\Financial\AccountsPayables\AccountsPayableResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditAccountsPayable extends EditRecord
{
    protected static string $resource = AccountsPayableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
