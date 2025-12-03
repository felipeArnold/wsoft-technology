<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Funnels\Pages;

use App\Filament\Clusters\Settings\CRM\Funnels\FunnelResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

final class CreateFunnel extends CreateRecord
{
    protected static string $resource = FunnelResource::class;

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
