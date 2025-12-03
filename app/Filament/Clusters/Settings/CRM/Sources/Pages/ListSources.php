<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Sources\Pages;

use App\Filament\Clusters\Settings\CRM\Sources\SourceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListSources extends ListRecords
{
    protected static string $resource = SourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Origem')
                ->icon('heroicon-o-plus'),
        ];
    }
}
