<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Pages;

use App\Filament\Resources\Services\ServiceOrders\ServiceOrderResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateServiceOrder extends CreateRecord
{
    protected static string $resource = ServiceOrderResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Ordem de serviço '.$this->record->number.' criada com sucesso';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->record]);
    }
}
