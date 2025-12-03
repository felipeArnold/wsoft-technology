<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Teams\Pages;

use App\Filament\Clusters\Settings\CRM\Teams\TeamResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewTeam extends ViewRecord
{
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
