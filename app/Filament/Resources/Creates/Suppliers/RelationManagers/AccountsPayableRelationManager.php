<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Suppliers\RelationManagers;

use App\Filament\Resources\Financial\AccountsPayables\AccountsPayableResource;
use App\Models\Accounts\Accounts;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class AccountsPayableRelationManager extends RelationManager
{
    protected static string $relationship = 'accounts';

    protected static ?string $title = 'Contas a Pagar';

    protected static ?string $modelLabel = 'Conta a Pagar';

    protected static ?string $pluralModelLabel = 'Contas a Pagar';

    protected static string|BackedEnum|null $icon = 'heroicon-o-currency-dollar';

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'payables')->with(['categories']))
            ->columns(Accounts::getTableColumns())
            ->recordActions([
                Action::make('edit')
                    ->label('Editar')
                    ->icon('heroicon-o-pencil')
                    ->url(fn (Action $action) => AccountsPayableResource::getUrl('edit', ['record' => $action->getRecord()])),
            ])
            ->defaultSort('due_date', 'desc')
            ->paginated([10, 25, 50]);
    }
}
