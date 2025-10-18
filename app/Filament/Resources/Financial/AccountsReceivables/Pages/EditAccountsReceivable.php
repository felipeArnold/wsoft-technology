<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsReceivables\Pages;

use App\Filament\Resources\Financial\AccountsReceivables\AccountsReceivableResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditAccountsReceivable extends EditRecord
{
    protected static string $resource = AccountsReceivableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
