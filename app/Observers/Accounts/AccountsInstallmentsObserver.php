<?php

declare(strict_types=1);

namespace App\Observers\Accounts;

use App\Models\Accounts\AccountsInstallments;
use Filament\Facades\Filament;

final class AccountsInstallmentsObserver
{
    public function creating(AccountsInstallments $installments): void
    {
        if (auth()->check()) {
            $installments->tenant_id = Filament::getTenant()->id;
        }

    }
}
