<?php

declare(strict_types=1);

namespace App\Filament\Resources\AI\AIGenerations\Pages;

use App\Filament\Resources\AI\AIGenerations\AIGenerationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListAIGenerations extends ListRecords
{
    protected static string $resource = AIGenerationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
