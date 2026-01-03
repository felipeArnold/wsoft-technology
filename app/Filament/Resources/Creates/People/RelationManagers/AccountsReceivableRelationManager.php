<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People\RelationManagers;

use App\Filament\Resources\Financial\AccountsReceivables\AccountsReceivableResource;
use App\Models\Accounts\Accounts;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class AccountsReceivableRelationManager extends RelationManager
{
    protected static string $relationship = 'accounts';

    protected static ?string $title = 'Contas a receber';

    protected static ?string $modelLabel = 'Conta a receber';

    protected static ?string $pluralModelLabel = 'Contas a receber';

    protected static string|BackedEnum|null $icon = 'heroicon-o-currency-dollar';

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'receivables')->with(['categories']))
            ->columns(Accounts::getTableColumns())
            ->recordActions([
                Action::make('edit')
                    ->label('Editar')
                    ->icon('heroicon-o-pencil')
                    ->url(fn (Action $action) => AccountsReceivableResource::getUrl('edit', ['record' => $action->getRecord()])),
            ])
            ->emptyStateIcon(Heroicon::ArrowTrendingDown)
            ->emptyStateHeading('Nenhuma conta a receber vinculada')
            ->emptyStateDescription('Crie contas a receber para que elas apareçam aqui.')
            ->defaultSort('due_date', 'desc')
            ->paginated([10, 25, 50]);
    }
}
