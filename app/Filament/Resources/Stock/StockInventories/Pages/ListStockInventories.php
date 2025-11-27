<?php

declare(strict_types=1);

namespace App\Filament\Resources\Stock\StockInventories\Pages;

use App\Filament\Resources\Stock\StockInventories\StockInventoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListStockInventories extends ListRecords
{
    protected static string $resource = StockInventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Novo Inventário'),
        ];
    }
}
