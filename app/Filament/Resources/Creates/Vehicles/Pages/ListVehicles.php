<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Vehicles\Pages;

use App\Filament\Resources\Creates\Vehicles\VehicleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListVehicles extends ListRecords
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Novo Veículo')
                ->icon('heroicon-o-plus'),
        ];
    }
}
