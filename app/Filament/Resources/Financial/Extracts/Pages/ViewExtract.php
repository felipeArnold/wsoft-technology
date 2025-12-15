<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Extracts\Pages;

use App\Filament\Resources\Financial\Extracts\ExtractResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewExtract extends ViewRecord
{
    protected static string $resource = ExtractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
