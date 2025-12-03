<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\LossReasons\Pages;

use App\Filament\Clusters\Settings\CRM\LossReasons\LossReasonResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

final class CreateLossReason extends CreateRecord
{
    protected static string $resource = LossReasonResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['tenant_id'] = Filament::getTenant()->id;
        $data['is_default'] = false;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
