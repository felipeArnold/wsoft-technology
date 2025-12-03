<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Teams\Pages;

use App\Filament\Clusters\Settings\CRM\Teams\TeamResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListTeams extends ListRecords
{
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Equipe')
                ->icon('heroicon-o-plus'),
        ];
    }
}
