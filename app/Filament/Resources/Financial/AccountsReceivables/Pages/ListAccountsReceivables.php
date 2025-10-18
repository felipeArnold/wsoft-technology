<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsReceivables\Pages;

use App\Filament\Resources\Financial\AccountsReceivables\AccountsReceivableResource;
use App\Filament\Resources\Financial\AccountsReceivables\Widgets\AccountsReceivablesOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListAccountsReceivables extends ListRecords
{
    protected static string $resource = AccountsReceivableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Nova conta')->icon('heroicon-o-plus'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AccountsReceivablesOverview::class,
        ];
    }
}
