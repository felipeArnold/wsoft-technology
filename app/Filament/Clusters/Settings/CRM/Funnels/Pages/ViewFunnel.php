<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Funnels\Pages;

use App\Filament\Clusters\Settings\CRM\Funnels\FunnelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewFunnel extends ViewRecord
{
    protected static string $resource = FunnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
