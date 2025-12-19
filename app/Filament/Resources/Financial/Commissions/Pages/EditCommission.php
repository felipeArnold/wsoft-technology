<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Commissions\Pages;

use App\Filament\Resources\Financial\Commissions\CommissionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditCommission extends EditRecord
{
    protected static string $resource = CommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
