<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Activities\Pages;

use App\Filament\Imports\ActivityImporter;
use App\Filament\Resources\Creates\Activities\ActivityResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

final class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova agenda')
                ->icon('heroicon-o-plus'),
            ImportAction::make()
                ->hiddenLabel()
                ->icon(Heroicon::OutlinedArrowUpTray)
                ->importer(ActivityImporter::class),
        ];
    }
}
