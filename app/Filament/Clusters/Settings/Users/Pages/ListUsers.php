<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Users\Pages;

use App\Filament\Clusters\Settings\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;

final class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Novo Usuário')
                ->icon('heroicon-o-plus')
                ->visible(function (): bool {
                    return Filament::getTenant()->members()->count() < 3;
                }),
        ];
    }
}
