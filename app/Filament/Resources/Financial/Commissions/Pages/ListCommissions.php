<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Commissions\Pages;

use App\Filament\Resources\Financial\Commissions\CommissionResource;
use Filament\Resources\Pages\ListRecords;

final class ListCommissions extends ListRecords
{
    protected static string $resource = CommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
