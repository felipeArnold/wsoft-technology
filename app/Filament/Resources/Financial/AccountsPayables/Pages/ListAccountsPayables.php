<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsPayables\Pages;

use App\Filament\Resources\Financial\AccountsPayables\AccountsPayableResource;
use App\Filament\Resources\Financial\AccountsPayables\Widgets\AccountsPayablesOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListAccountsPayables extends ListRecords
{
    protected static string $resource = AccountsPayableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Conta')
                ->icon('heroicon-s-plus'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AccountsPayablesOverview::class,
        ];
    }
}
