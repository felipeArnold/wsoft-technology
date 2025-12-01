<?php

declare(strict_types=1);

namespace App\Filament\Resources\AI\AIGenerations\Pages;

use App\Filament\Resources\AI\AIGenerations\AIGenerationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditAIGeneration extends EditRecord
{
    protected static string $resource = AIGenerationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
