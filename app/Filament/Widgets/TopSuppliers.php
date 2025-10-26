<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Person\Person;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

final class TopSuppliers extends BaseWidget
{
    protected static ?string $heading = 'Principais Fornecedores';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        return $table
            ->query(
                Person::query()
                    ->where('tipo', 'fornecedor')
                    ->whereHas('accounts', function ($query) use ($startOfYear, $endOfYear): void {
                        $query->where('type', 'payables')
                            ->whereHas('installments', function ($subQuery) use ($startOfYear, $endOfYear): void {
                                $subQuery->where('status', PaymentStatusEnum::PAID)
                                    ->whereBetween('paid_at', [$startOfYear, $endOfYear]);
                            });
                    })
                    ->withCount([
                        'accounts as total_payables' => function ($query) use ($startOfYear, $endOfYear): void {
                            $query->where('type', 'payables')
                                ->whereHas('installments', function ($subQuery) use ($startOfYear, $endOfYear): void {
                                    $subQuery->where('status', PaymentStatusEnum::PAID)
                                        ->whereBetween('paid_at', [$startOfYear, $endOfYear]);
                                });
                        },
                    ])
                    ->withSum([
                        'accounts as total_amount' => function ($query) use ($startOfYear, $endOfYear): void {
                            $query->where('type', 'payables')
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
                    ->label('Nome do Fornecedor')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('document')
                    ->label('CNPJ')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_payables_count')
                    ->label('Qtd. Contas')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_amount_sum')
                    ->label('Total Pago')
                    ->money('BRL')
                    ->sortable(),

                Tables\Columns\TextColumn::make('accounts_sum_open_amount')
                    ->label('Em Aberto')
                    ->getStateUsing(function (Person $record): float {
                        return $record->accounts()
                            ->where('type', 'payables')
                            ->whereIn('status', ['aberta', 'parcial'])
                            ->sum('valor_liquido');
                    })
                    ->money('BRL'),
            ])
            ->defaultSort('total_amount_sum', 'desc')
            ->paginated([5, 10, 15]);
    }
}
