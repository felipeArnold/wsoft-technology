<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Categories\Pages;

use App\Filament\Clusters\Settings\Categories\CategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewCategory extends ViewRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
