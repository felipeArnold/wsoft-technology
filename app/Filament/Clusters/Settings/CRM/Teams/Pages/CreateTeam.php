<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Teams\Pages;

use App\Filament\Clusters\Settings\CRM\Teams\TeamResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

final class CreateTeam extends CreateRecord
{
    protected static string $resource = TeamResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['tenant_id'] = Filament::getTenant()->id;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
