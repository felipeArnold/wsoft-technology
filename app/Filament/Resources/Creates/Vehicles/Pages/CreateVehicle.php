<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Vehicles\Pages;

use App\Filament\Resources\Creates\Vehicles\VehicleResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateVehicle extends CreateRecord
{
    protected static string $resource = VehicleResource::class;
}
