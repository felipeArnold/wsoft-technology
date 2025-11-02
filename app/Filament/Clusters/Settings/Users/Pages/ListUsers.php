<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Users\Pages;

use App\Filament\Clusters\Settings\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Exceptions\Halt;

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
                })
                ->before(function () {
                    $memberCount = Filament::getTenant()->members()->count();

                    if ($memberCount >= 3) {
                        Notification::make()
                            ->title('Limite de usuários atingido')
                            ->body('Sua empresa já possui o número máximo de 3 usuários cadastrados.')
                            ->danger()
                            ->send();

                        throw new Halt();
                    }
                }),
        ];
    }
}
