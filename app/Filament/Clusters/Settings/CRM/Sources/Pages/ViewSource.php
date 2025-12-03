<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Sources\Pages;

use App\Filament\Clusters\Settings\CRM\Sources\SourceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewSource extends ViewRecord
{
    protected static string $resource = SourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->disabled(fn ($record) => $record->is_default === true),
        ];
    }
}
