<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Activities\Pages;

use App\Filament\Resources\Creates\Activities\ActivityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Atividade')
                ->icon('heroicon-o-plus'),
        ];
    }
}
