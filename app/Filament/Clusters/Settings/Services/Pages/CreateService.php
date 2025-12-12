<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Services\Pages;

use App\Filament\Clusters\Settings\Services\ServiceResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

final class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

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
