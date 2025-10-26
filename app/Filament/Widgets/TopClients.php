<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Person\Person;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

final class TopClients extends BaseWidget
{
    protected static ?string $heading = 'Principais Clientes';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        return $table
            ->query(
                Person::query()
                    ->where('tipo', 'cliente')
                    ->whereHas('accounts', function ($query) use ($startOfYear, $endOfYear): void {
                        $query->where('type', 'receivables')
                            ->whereHas('installments', function ($subQuery) use ($startOfYear, $endOfYear): void {
                                $subQuery->where('status', PaymentStatusEnum::PAID)
                                    ->whereBetween('paid_at', [$startOfYear, $endOfYear]);
                            });
                    })
                    ->withCount([
                        'accounts as total_receivables' => function ($query) use ($startOfYear, $endOfYear): void {
                            $query->where('type', 'receivables')
                                ->whereHas('installments', function ($subQuery) use ($startOfYear, $endOfYear): void {
                                    $subQuery->where('status', PaymentStatusEnum::PAID)
                                        ->whereBetween('paid_at', [$startOfYear, $endOfYear]);
                                });
                        },
                    ])
                    ->withSum([
                        'accounts as total_amount' => function ($query) use ($startOfYear, $endOfYear): void {
                            $query->where('type', 'receivables')
                                ->whereHas('installments', function ($subQuery) use ($startOfYear, $endOfYear): void {
                                    $subQuery->where('status', PaymentStatusEnum::PAID)
                                        ->whereBetween('paid_at', [$startOfYear, $endOfYear]);
                                });
                        },
                    ], 'amount')
                    ->orderBy('total_amount_sum', 'desc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome do Cliente')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('document')
                    ->label('CPF/CNPJ')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_receivables_count')
                    ->label('Qtd. Contas')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_amount_sum')
                    ->label('Total Recebido')
                    ->money('BRL')
                    ->sortable(),

                Tables\Columns\TextColumn::make('accounts_sum_open_amount')
                    ->label('Em Aberto')
                    ->getStateUsing(function (Person $record): float {
                        return $record->where('type', 'receivables')
                            ->whereIn('status', ['aberta', 'parcial'])
                            ->sum('valor_liquido');
                    })
                    ->money('BRL'),
            ])
            ->defaultSort('total_amount_sum', 'desc')
            ->paginated([5, 10, 15]);
    }
}
