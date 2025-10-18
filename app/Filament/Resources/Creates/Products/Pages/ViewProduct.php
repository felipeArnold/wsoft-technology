<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Products\Pages;

use App\Filament\Resources\Creates\Products\ProductResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
