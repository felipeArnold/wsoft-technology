<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Warranties\Pages;

use App\Filament\Resources\Services\Warranties\WarrantyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewWarranty extends ViewRecord
{
    protected static string $resource = WarrantyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
