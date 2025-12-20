<?php

namespace App\Filament\Resources\Services\Warranties\Pages;

use App\Filament\Resources\Services\Warranties\WarrantyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWarranties extends ListRecords
{
    protected static string $resource = WarrantyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
