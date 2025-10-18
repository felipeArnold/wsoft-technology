<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsReceivables\Pages;

use App\Filament\Resources\Financial\AccountsReceivables\AccountsReceivableResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateAccountsReceivable extends CreateRecord
{
    protected static string $resource = AccountsReceivableResource::class;
}
