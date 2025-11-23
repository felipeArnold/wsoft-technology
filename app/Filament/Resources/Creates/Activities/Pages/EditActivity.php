<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Activities\Pages;

use App\Filament\Resources\Creates\Activities\ActivityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditActivity extends EditRecord
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Excluir'),
        ];
    }
}
