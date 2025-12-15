<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsPayables\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Models\Accounts\AccountsInstallments;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Support\Str;

final class AccountsPayablesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(AccountsInstallments::query()->whereHas('accounts', fn ($q) => $q->where('type', 'payables')))
            ->columns([
                TextColumn::make('accounts.person.name')
                    ->label('Fornecedor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('installment_number')
                    ->label('Parcela')
                    ->formatStateUsing(function ($state, $record) {
                        $accounts = $record->accounts;
                        if (! $accounts) {
                            return $state;
                        }

                        return Str::of($state)->padLeft(2, '0').'/'.Str::of($accounts->parcels)->padLeft(2, '0');
                    })
                    ->badge()
                    ->color('info')
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Valor')
                    ->money('BRL')
                    ->color('success')
                    ->sortable()
                    ->summarize([
                        Sum::make()->label('Total a pagar')->money('BRL'),
                    ]),
                TextColumn::make('due_date')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->sortable()
                    ->color(fn ($record) => $record->due_date->isPast() && ! $record->status->value ? 'danger' : 'gray')
                    ->icon(fn ($record) => $record->due_date->isPast() && ! $record->status->value ? 'heroicon-o-exclamation-triangle' : 'heroicon-o-calendar'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(function ($state, $record) {
                        if ($state->value) {
                            return 'Pago';
                        }
                        if ($record->due_date->isPast()) {
                            return 'Vencido';
                        }

                        return 'Pendente';
                    })
                    ->colors([
                        'success' => fn ($state) => $state->value,
                        'danger' => fn ($state, $record) => ! $state->value && $record->due_date->isPast(),
                        'warning' => fn ($state, $record) => ! $state->value && ! $record->due_date->isPast(),
                    ])
                    ->icons([
                        'heroicon-o-check-circle' => fn ($state) => $state->value,
                        'heroicon-o-exclamation-triangle' => fn ($state, $record) => ! $state->value && $record->due_date->isPast(),
                        'heroicon-o-clock' => fn ($state, $record) => ! $state->value && ! $record->due_date->isPast(),
                    ])
                    ->sortable(),
                TextColumn::make('accounts.payment_method')
                    ->label('Forma de Pagamento')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state?->getLabel() ?? $state)
                    ->color(fn ($state) => $state?->getColor() ?? 'gray')
                    ->icon(fn ($state) => $state?->getIcon() ?? 'heroicon-o-credit-card')
                    ->sortable(),
                TextColumn::make('accounts.reference_number')
                    ->label('Referência')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('accounts.categories.name')
                    ->label('Categorias')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->separator(',')
                    ->placeholder('—'),
                TextColumn::make('paid_at')
                    ->label('Pago em')
                    ->date('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('—'),
            ])
            ->filters([
                Filter::make('month')
                    ->label('Mês de Referência')
                    ->form([
                        TextInput::make('month')
                            ->label('Mês de referência')
                            ->placeholder('Selecione o mês')
                            ->prefixIcon('heroicon-m-calendar')
                            ->type('month')
                            ->default(Carbon::now()->format('Y-m'))
                            ->reactive(),
                    ])
                    ->query(function ($query, array $data): void {
                        if (filled($data['month'])) {
                            $carbon = Carbon::parse($data['month']);
                            $month = $carbon->month;
                            $year = $carbon->year;
                            $query->whereMonth('due_date', $month)->whereYear('due_date', $year);
                        }
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (! filled($data['month'])) {
                            return null;
                        }

                        return 'Mês: '.Carbon::parse($data['month'])->translatedFormat('F/Y');
                    }),

                Filter::make('date_range')
                    ->label('Período')
                    ->form([
                        DatePicker::make('date_from')
                            ->label('De')
                            ->placeholder('Data inicial')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->closeOnDateSelection()
                            ->maxDate(fn (callable $get) => $get('date_until') ?: now()->addYear()),
                        DatePicker::make('date_until')
                            ->label('Até')
                            ->placeholder('Data final')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->closeOnDateSelection()
                            ->minDate(fn (callable $get) => $get('date_from'))
                            ->maxDate(now()->addYear()),
                    ])
                    ->columns(2)
                    ->query(function ($query, array $data): void {
                        $query
                            ->when(filled($data['date_from']), fn ($q) => $q->whereDate('due_date', '>=', $data['date_from']))
                            ->when(filled($data['date_until']), fn ($q) => $q->whereDate('due_date', '<=', $data['date_until']));
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (! filled($data['date_from']) && ! filled($data['date_until'])) {
                            return null;
                        }

                        $from = filled($data['date_from']) ? Carbon::parse($data['date_from'])->format('d/m/Y') : '...';
                        $until = filled($data['date_until']) ? Carbon::parse($data['date_until'])->format('d/m/Y') : '...';

                        return "Período: {$from} até {$until}";
                    }),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        0 => 'Pendente',
                        1 => 'Pago',
                    ])
                    ->query(function ($query, array $data): void {
                        if (filled($data['value'])) {
                            $query->where('status', $data['value']);
                        }
                    })
                    ->native(false)
                    ->placeholder('Todos os status')
                    ->indicateUsing(function (array $data): ?string {
                        if (! filled($data['value'])) {
                            return null;
                        }

                        return 'Status: '.($data['value'] ? 'Pago' : 'Pendente');
                    }),

                SelectFilter::make('supplier')
                    ->label('Fornecedor')
                    ->relationship('accounts.person', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->placeholder('Todos os fornecedores')
                    ->indicateUsing(function (array $data): ?string {
                        if (! filled($data['value'])) {
                            return null;
                        }

                        $person = \App\Models\Person\Person::find($data['value']);

                        return $person ? 'Fornecedor: '.$person->name : null;
                    }),

                SelectFilter::make('payment_method')
                    ->label('Forma de Pagamento')
                    ->options(\App\Enum\AccountsReceivable\PaymentMethodEnum::class)
                    ->query(function ($query, array $data): void {
                        if (filled($data['value'])) {
                            $query->whereHas('accounts', fn ($q) => $q->where('payment_method', $data['value']));
                        }
                    })
                    ->native(false)
                    ->placeholder('Todas as formas')
                    ->indicateUsing(function (array $data): ?string {
                        if (! filled($data['value'])) {
                            return null;
                        }

                        $paymentMethod = \App\Enum\AccountsReceivable\PaymentMethodEnum::tryFrom($data['value']);

                        return $paymentMethod ? 'Forma: '.$paymentMethod->getLabel() : null;
                    }),

                SelectFilter::make('categories')
                    ->label('Categorias')
                    ->relationship('accounts.categories', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->multiple()
                    ->placeholder('Todas as categorias')
                    ->indicateUsing(function (array $data): ?string {
                        if (! filled($data['values']) || empty($data['values'])) {
                            return null;
                        }

                        $categories = \App\Models\Category::whereIn('id', $data['values'])->pluck('name')->toArray();

                        return 'Categorias: '.implode(', ', $categories);
                    }),

                Filter::make('amount_range')
                    ->label('Faixa de Valor')
                    ->form([
                        TextInput::make('amount_from')
                            ->label('Valor mínimo')
                            ->placeholder('R$ 0,00')
                            ->numeric()
                            ->prefix('R$')
                            ->minValue(0),
                        TextInput::make('amount_until')
                            ->label('Valor máximo')
                            ->placeholder('R$ 999.999,99')
                            ->numeric()
                            ->prefix('R$')
                            ->minValue(0),
                    ])
                    ->columns(2)
                    ->query(function ($query, array $data): void {
                        $query
                            ->when(filled($data['amount_from']), fn ($q) => $q->where('amount', '>=', $data['amount_from']))
                            ->when(filled($data['amount_until']), fn ($q) => $q->where('amount', '<=', $data['amount_until']));
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (! filled($data['amount_from']) && ! filled($data['amount_until'])) {
                            return null;
                        }

                        $from = filled($data['amount_from']) ? 'R$ '.number_format($data['amount_from'], 2, ',', '.') : 'R$ 0,00';
                        $until = filled($data['amount_until']) ? 'R$ '.number_format($data['amount_until'], 2, ',', '.') : '∞';

                        return "Valor: {$from} até {$until}";
                    }),

                TernaryFilter::make('overdue')
                    ->label('Vencidas')
                    ->placeholder('Todas')
                    ->trueLabel('Apenas vencidas')
                    ->falseLabel('Não vencidas')
                    ->queries(
                        true: fn ($query) => $query->where('due_date', '<', now())->where('status', 0),
                        false: fn ($query) => $query->where(fn ($q) => $q->where('due_date', '>=', now())->orWhere('status', 1)),
                    )
                    ->native(false)
                    ->indicateUsing(function (array $data): ?string {
                        if (! isset($data['value']) || $data['value'] === null) {
                            return null;
                        }

                        return $data['value'] ? 'Apenas vencidas' : 'Não vencidas';
                    }),

                TernaryFilter::make('due_today')
                    ->label('Vence Hoje')
                    ->placeholder('Todas')
                    ->trueLabel('Sim')
                    ->falseLabel('Não')
                    ->queries(
                        true: fn ($query) => $query->whereDate('due_date', now())->where('status', 0),
                        false: fn ($query) => $query->where(fn ($q) => $q->whereDate('due_date', '!=', now())->orWhere('status', 1)),
                    )
                    ->native(false)
                    ->indicateUsing(function (array $data): ?string {
                        if (! isset($data['value']) || $data['value'] === null) {
                            return null;
                        }

                        return $data['value'] ? 'Vence hoje' : 'Não vence hoje';
                    }),

                SelectFilter::make('due_period')
                    ->label('Vencimento')
                    ->options([
                        'next_7' => 'Próximos 7 dias',
                        'next_15' => 'Próximos 15 dias',
                        'next_30' => 'Próximos 30 dias',
                        'current_month' => 'Mês atual',
                        'next_month' => 'Próximo mês',
                    ])
                    ->query(function ($query, array $data): void {
                        if (! filled($data['value'])) {
                            return;
                        }

                        match ($data['value']) {
                            'next_7' => $query->whereBetween('due_date', [now(), now()->addDays(7)])->where('status', 0),
                            'next_15' => $query->whereBetween('due_date', [now(), now()->addDays(15)])->where('status', 0),
                            'next_30' => $query->whereBetween('due_date', [now(), now()->addDays(30)])->where('status', 0),
                            'current_month' => $query->whereMonth('due_date', now()->month)->whereYear('due_date', now()->year)->where('status', 0),
                            'next_month' => $query->whereMonth('due_date', now()->addMonth()->month)->whereYear('due_date', now()->addMonth()->year)->where('status', 0),
                            default => null,
                        };
                    })
                    ->native(false)
                    ->placeholder('Todos os períodos')
                    ->indicateUsing(function (array $data): ?string {
                        if (! filled($data['value'])) {
                            return null;
                        }

                        return match ($data['value']) {
                            'next_7' => 'Vencimento: Próximos 7 dias',
                            'next_15' => 'Vencimento: Próximos 15 dias',
                            'next_30' => 'Vencimento: Próximos 30 dias',
                            'current_month' => 'Vencimento: Mês atual',
                            'next_month' => 'Vencimento: Próximo mês',
                            default => null,
                        };
                    }),
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filtros')
                    ->icon('heroicon-o-funnel')
            )
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('mark_as_received')
                    ->label('Marcar como Pago')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => ! $record->status->value)
                    ->requiresConfirmation()
                    ->action(function ($record): void {
                        $record->update([
                            'status' => 1,
                            'paid_at' => now(),
                        ]);

                        $account = $record->accounts;

                        if ($account && $account->recurring && $record->installment_number === $account->parcels) {

                            $newDueDate = $record->due_date->copy()->addMonth();

                            // Valor da nova parcela
                            $newInstallmentAmount = $record->amount;

                            // Resetar o valor da última parcela paga
                            $record->update([
                                'amount' => 0,
                            ]);

                            // Criar nova parcela
                            AccountsInstallments::create([
                                'tenant_id' => $record->tenant_id,
                                'accounts_id' => $account->id,
                                'installment_number' => $record->installment_number + 1,
                                'amount' => $newInstallmentAmount,
                                'due_date' => $newDueDate,
                                'status' => 0,
                            ]);

                            // Atualizar parcelas e valor total da conta
                            $account->update([
                                'parcels' => $account->parcels + 1,
                                'amount' => $account->amount + $newInstallmentAmount,
                            ]);

                            Notification::make()
                                ->title('Conta recorrente criada!')
                                ->success()
                                ->body('Uma nova parcela foi criada para a conta recorrente.')
                                ->send();
                        }
                    }),
                Action::make('mark_as_pending')
                    ->label('Marcar como Pendente')
                    ->icon('heroicon-o-x-circle')
                    ->color('warning')
                    ->visible(fn ($record) => $record->status->value)
                    ->requiresConfirmation()
                    ->action(function ($record): void {
                        $record->update([
                            'status' => 0,
                            'paid_at' => null,
                        ]);
                    }),
            ])
            ->groups([
                Group::make('Status')->collapsible(),
                Group::make('accounts.categories.name')->label('Categorias')->collapsible(),
                Group::make('accounts.payment_method')->label('Forma de Pagamento')->collapsible(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    Action::make('mark_all_received')
                        ->label('Marcar como Pago')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records): void {
                            $records->each(function ($record): void {
                                $record->update([
                                    'status' => 1,
                                    'paid_at' => now(),
                                ]);

                                $account = $record->accounts;

                                if ($account && $account->recurring && $record->installment_number === $account->parcels) {

                                    $newDueDate = $record->due_date->copy()->addMonth();

                                    // Valor da nova parcela
                                    $newInstallmentAmount = $record->amount;

                                    // Resetar o valor da última parcela paga
                                    $record->update([
                                        'amount' => 0,
                                    ]);

                                    // Criar nova parcela
                                    AccountsInstallments::query()->create([
                                        'tenant_id' => $record->tenant_id,
                                        'accounts_id' => $account->id,
                                        'installment_number' => $record->installment_number + 1,
                                        'amount' => $newInstallmentAmount,
                                        'due_date' => $newDueDate,
                                        'status' => 0,
                                    ]);

                                    // Atualizar parcelas e valor total da conta
                                    $account->update([
                                        'parcels' => $account->parcels + 1,
                                        'amount' => $account->amount + $newInstallmentAmount,
                                    ]);

                                    Notification::make()
                                        ->title('Conta recorrente criada!')
                                        ->success()
                                        ->body('Uma nova parcela foi criada para a conta recorrente.')
                                        ->send();
                                }
                            });
                        }),
                    Action::make('mark_all_pending')
                        ->label('Marcar como Pendente')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function ($records): void {
                            $records->each(function ($record): void {
                                $record->update([
                                    'status' => 0,
                                    'paid_at' => null,
                                ]);
                            });
                        }),
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-arrow-down-circle')
            ->emptyStateHeading('Nenhuma conta a pagar encontrada')
            ->emptyStateDescription('Crie uma nova conta a pagar para começar.')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Criar nova conta a pagar')
                    ->icon('heroicon-m-plus')
                    ->url('accounts-payables/create'),
            ])
            ->recordUrl(function ($record) {
                return 'accounts-payables/'.$record->accounts->id.'/edit';
            })
            ->defaultSort('due_date');
    }
}
