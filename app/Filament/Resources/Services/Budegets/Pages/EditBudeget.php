<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Budegets\Pages;

use App\Filament\Resources\Services\Budegets\BudegetResource;
use App\Filament\Resources\Services\ServiceOrders\Actions\ConvertBudgetToServiceOrderAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditBudeget extends EditRecord
{
    protected static string $resource = BudegetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ConvertBudgetToServiceOrderAction::make(),
            DeleteAction::make(),
        ];
    }
}
