<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Extracts\Schemas;

use App\Filament\Resources\Financial\Shared\Schemas\AccountsInstallmentFormComponents;
use Filament\Schemas\Schema;

final class ExtractForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components(AccountsInstallmentFormComponents::getAllComponents());
    }
}
