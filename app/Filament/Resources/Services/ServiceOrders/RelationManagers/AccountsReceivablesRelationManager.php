<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\RelationManagers;

use App\Filament\Resources\Financial\AccountsReceivables\AccountsReceivableResource;
use App\Models\Accounts\Accounts;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class AccountsReceivablesRelationManager extends RelationManager
{
    protected static string $relationship = 'accounts';

    protected static ?string $title = 'Contas a Receber';

    protected static ?string $modelLabel = 'Conta a Receber';

    protected static ?string $pluralModelLabel = 'Contas a Receber';

    protected static string|BackedEnum|null $icon = 'heroicon-o-banknotes';

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->where('type', 'receivables')
                ->where('service_order_id', $this->getOwnerRecord()->id)
                ->with(['categories'])
            )
            ->columns(Accounts::getTableColumns())
            ->headerActions([
                CreateAction::make()
                    ->label('Nova Conta a Receber')
                    ->icon('heroicon-o-plus')
                    ->url(fn () => AccountsReceivableResource::getUrl('create', [
                        'service_order_id' => $this->getOwnerRecord()->id,
                    ])),
            ])
            ->recordActions([
                Action::make('edit')
                    ->label('Editar')
                    ->icon('heroicon-o-pencil')
                    ->url(fn (Action $action) => AccountsReceivableResource::getUrl('edit', ['record' => $action->getRecord()])),
                Action::make('view')
                    ->label('Visualizar')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Action $action) => AccountsReceivableResource::getUrl('edit', ['record' => $action->getRecord()])),
            ])
            ->defaultSort('due_date', 'desc')
            ->paginated([10, 25, 50])
            ->emptyStateHeading('Nenhuma conta a receber')
            ->emptyStateDescription('Esta ordem de serviço ainda não possui contas a receber.')
            ->emptyStateIcon('heroicon-o-banknotes');
    }
}
