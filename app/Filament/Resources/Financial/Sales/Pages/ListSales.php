<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Sales\Pages;

use App\Filament\Resources\Financial\Sales\SaleResource;
use App\Filament\Resources\Financial\Sales\Widgets\SalesOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListSales extends ListRecords
{
    protected static string $resource = SaleResource::class;

    public function getHeaderWidgetsColumns(): int|array
    {
        return 4;
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SalesOverview::class,
        ];
    }
}
