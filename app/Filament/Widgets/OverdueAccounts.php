<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

final class OverdueAccounts extends BaseWidget
{
    protected static ?string $heading = 'Contas Vencidas';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                AccountsInstallments::query()
                    ->where('status', '<>', PaymentStatusEnum::PAID)
                    ->with(['accounts.person', 'accounts'])
                    ->orderBy('due_date', 'asc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('accounts.numero')
                    ->label('Número')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('accounts.person.name')
                    ->label('Cliente/Fornecedor')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('accounts.descricao')
                    ->label('Descrição')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('due_date')
                    ->label('Data de Vencimento')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Valor')
                    ->money('BRL')
                    ->sortable(),

                Tables\Columns\TextColumn::make('days_overdue')
                    ->label('Dias em Atraso')
                    ->getStateUsing(function (AccountsInstallments $record): int {
                        if (! $record->due_date) {
                            return 0;
                        }

                        return (int) Carbon::now()->diffInDays($record->due_date);
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('accounts.type')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'receivables' => 'success',
                        'payables' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'receivables' => 'A Receber',
                        'payables' => 'A Pagar',
                        default => $state,
                    }),
            ])
            ->defaultSort('due_date', 'asc')
            ->paginated([10, 25, 50]);
    }
}
