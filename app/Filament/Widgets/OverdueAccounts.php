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

    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                AccountsInstallments::query()
                    ->where('status', '<>', PaymentStatusEnum::PAID)
                    ->where('due_date', '<', Carbon::today())
                    ->with(['accounts.person', 'accounts'])
                    ->orderBy('due_date', 'asc')
            )
            ->columns([
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
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo de Conta')
                    ->options([
                        'receivables' => 'A Receber',
                        'payables' => 'A Pagar',
                    ])
                    ->query(function ($query, array $data) {
                        if (filled($data['value'])) {
                            $query->whereHas('accounts', function ($q) use ($data) {
                                $q->where('type', $data['value']);
                            });
                        }
                    }),
            ])
            ->defaultSort('due_date', 'asc')
            ->paginated([10, 25, 50]);
    }
}
