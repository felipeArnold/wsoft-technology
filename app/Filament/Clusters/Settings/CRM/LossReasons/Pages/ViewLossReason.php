<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\LossReasons\Pages;

use App\Filament\Clusters\Settings\CRM\LossReasons\LossReasonResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewLossReason extends ViewRecord
{
    protected static string $resource = LossReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->disabled(fn ($record) => $record->is_default === true),
        ];
    }
}
