<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People\RelationManagers;

use App\Filament\Resources\Financial\AccountsReceivables\AccountsReceivableResource;
use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class AccountsReceivableRelationManager extends RelationManager
{
    protected static string $relationship = 'accounts';

    protected static ?string $title = 'Contas a receber';

    protected static ?string $modelLabel = 'Conta a receber';

    protected static ?string $pluralModelLabel = 'Contas a receber';

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'receivables'))
            ->columns([
                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('amount')
                    ->label('Valor')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('parcels')
                    ->label('Parcelas')
                    ->formatStateUsing(fn ($state) => $state.' x'),
                TextColumn::make('due_date')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'open' => 'warning',
                        'overdue' => 'danger',
                        'partial' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('payment_method')
                    ->label('Forma de Pagamento')
                    ->placeholder('—'),
            ])
            ->recordActions([
                Action::make('edit')
                    ->label('Editar')
                    ->icon('heroicon-o-pencil')
                    ->url(fn (Action $action) => AccountsReceivableResource::getUrl('edit', ['record' => $action->getRecord()])),
            ])
            ->defaultSort('due_date', 'desc')
            ->paginated([10, 25, 50]);
    }
}
