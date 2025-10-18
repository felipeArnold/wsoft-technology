<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People\Pages;

use App\Filament\Resources\Creates\People\PersonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListPeople extends ListRecords
{
    protected static string $resource = PersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Pessoa')
                ->icon('heroicon-o-plus'),
        ];
    }
}
