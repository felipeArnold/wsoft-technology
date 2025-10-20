<?php

namespace App\Filament\Resources\Creates\Suppliers\Pages;

use App\Filament\Resources\Creates\Suppliers\SupplierResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSuppliers extends ListRecords
{
    protected static string $resource = SupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Novo Fornecedor')->icon('heroicon-s-plus'),
        ];
    }
}
