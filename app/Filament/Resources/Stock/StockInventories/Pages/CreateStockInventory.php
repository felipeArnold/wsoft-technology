<?php

declare(strict_types=1);

namespace App\Filament\Resources\Stock\StockInventories\Pages;

use App\Filament\Resources\Stock\StockInventories\StockInventoryResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

final class CreateStockInventory extends CreateRecord
{
    protected static string $resource = StockInventoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['tenant_id'] = Filament::getTenant()->id;
        $data['created_by'] = auth()->id();

        // Se o status for "in_progress", registra a data de início
        if ($data['status'] === 'in_progress') {
            $data['started_at'] = now();
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record]);
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Inventário criado com sucesso!';
    }
}
