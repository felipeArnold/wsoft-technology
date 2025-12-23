<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Vehicles\Pages;

use App\Filament\Resources\Creates\Vehicles\VehicleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditVehicle extends EditRecord
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
