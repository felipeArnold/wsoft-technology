<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Budegets\Pages;

use App\Filament\Resources\Services\Budegets\BudegetResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListBudegets extends ListRecords
{
    protected static string $resource = BudegetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-s-plus')
                ->label('Criar Orçamento'),
        ];
    }
}
