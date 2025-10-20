<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Suppliers\Pages;

use App\Filament\Resources\Creates\Suppliers\SupplierResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditSupplier extends EditRecord
{
    protected static string $resource = SupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
