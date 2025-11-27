<?php

declare(strict_types=1);

namespace App\Filament\Resources\Stock\StockMovements\Pages;

use App\Filament\Resources\Stock\StockMovements\StockMovementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListStockMovements extends ListRecords
{
    protected static string $resource = StockMovementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nova Movimentação'),
        ];
    }
}
