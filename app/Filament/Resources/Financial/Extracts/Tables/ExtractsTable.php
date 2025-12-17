<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Extracts\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Models\Accounts\AccountsInstallments;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Support\Str;

final class ExtractsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(AccountsInstallments::query())
            ->columns([
                TextColumn::make('accounts.type')
                    ->label('Tipo')
                    ->formatStateUsing(function ($state, $record) {
                        return $state === 'receivables' ? 'Receita' : 'Despesa';
                    })
                    ->badge()
                    ->colors([
                        'success' => fn ($state) => $state === 'receivables',
                        'danger' => fn ($state) => $state === 'payables',
                    ])
                    ->icons([
                        'heroicon-o-arrow-up-circle' => fn ($state) => $state === 'receivables',
                        'heroicon-o-arrow-down-circle' => fn ($state) => $state === 'payables',
                    ])
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('accounts.person.name')
                    ->label('Cliente/Fornecedor')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
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
                    ->color('gray')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('amount')
                    ->label('Valor')
                    ->money('BRL')
                    ->color(fn ($record) => $record->accounts->type === 'receivables' ? 'success' : 'danger')
                    ->alignEnd()
                    ->toggleable()
                    ->summarize([
                        Sum::make()
                            ->label('Total Receitas')
                            ->money('BRL')
                            ->using(fn ($query) => $query->whereHas('accounts', fn ($q) => $q->where('type', 'receivables'))->sum('amount')),
                        Sum::make()
                            ->label('Total Despesas')
                            ->money('BRL')
                            ->using(fn ($query) => $query->whereHas('accounts', fn ($q) => $q->where('type', 'payables'))->sum('amount')),
                        Sum::make()
                            ->label('Saldo')
                            ->money('BRL')
                            ->using(function ($query) {
                                $receitas = $query->whereHas('accounts', fn ($q) => $q->where('type', 'receivables'))->sum('amount');
                                $despesas = $query->whereHas('accounts', fn ($q) => $q->where('type', 'payables'))->sum('amount');

                                return $receitas - $despesas;
                            }),
                    ]),
                TextColumn::make('due_date')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable()
                    ->color(fn ($record) => $record->due_date->isPast() && ! $record->status->value ? 'danger' : 'gray'),
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
                        'success' => fn ($state, $record) => $state->value,
                        'danger' => fn ($state, $record) => ! $state->value && $record->due_date->isPast(),
                        'warning' => fn ($state, $record) => ! $state->value && ! $record->due_date->isPast(),
                    ])
                    ->icons([
                        'heroicon-o-check-circle' => fn ($state) => $state->value,
                        'heroicon-o-exclamation-triangle' => fn ($state, $record) => ! $state->value && $record->due_date->isPast(),
                        'heroicon-o-clock' => fn ($state, $record) => ! $state->value && ! $record->due_date->isPast(),
                    ])
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('accounts.payment_method')
                    ->label('Pagamento')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state?->getLabel() ?? $state)
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('accounts.reference_number')
                    ->label('Referência')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('accounts.category')
                    ->label('Categoria')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('accounts.user.name')
                    ->label('Responsável')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('paid_at')
                    ->label('Pago em')
                    ->date('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('accounts.created_at')
                    ->label('Criado em')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state): void {
                                $set('month', $state);
                            }),
                    ])
                    ->query(function ($query, array $data): void {
                        if (filled($data['month'])) {
                            $carbon = Carbon::parse($data['month']);
                            $month = $carbon->month;
                            $year = $carbon->year;

                            $query->whereMonth('due_date', $month)->whereYear('due_date', $year);
                        }
                    }),
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->relationship('accounts', 'type')
                    ->options([
                        'receivables' => 'Receitas',
                        'payables' => 'Despesas',
                    ]),
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
                    }),
                SelectFilter::make('payment_method')
                    ->label('Forma de Pagamento')
                    ->relationship('accounts', 'payment_method')
                    ->searchable()
                    ->placeholder('Selecione a forma de pagamento'),
                SelectFilter::make('responsible')
                    ->label('Responsável')
                    ->relationship('accounts.user', 'name')
                    ->searchable()
                    ->placeholder('Selecione o responsável'),
                Filter::make('overdue')
                    ->label('Vencidas')
                    ->query(function ($query): void {
                        $query->where('due_date', '<', now())
                            ->where('status', 0);
                    })
                    ->toggle(),
                Filter::make('paid')
                    ->label('Pagas')
                    ->query(function ($query): void {
                        $query->where('status', 1);
                    })
                    ->toggle(),
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filtros')
                    ->icon('heroicon-o-funnel')
            )
            ->groups([
                Group::make('accounts.type')->label('Tipo')->collapsible(),
                Group::make('status')->label('Status')->collapsible(),
                Group::make('accounts.user.name')->label('Responsável')->collapsible(),
                Group::make('accounts.payment_method')->label('Forma de Pagamento')->collapsible(),
                Group::make('due_date')->label('Mês de Vencimento')->collapsible(),
            ])
            ->recordActions([
                ViewAction::make()->hiddenLabel()->tooltip('Visualizar Detalhes'),
                EditAction::make()->hiddenLabel()->tooltip('Editar Extrato'),
                Action::make('mark_as_paid')
                    ->hiddenLabel()
                    ->tooltip('Marcar como Pago')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => ! $record->status->value)
                    ->requiresConfirmation()
                    ->action(function ($record): void {
                        $record->update([
                            'status' => 1,
                            'paid_at' => now(),
                        ]);
                    }),
                Action::make('mark_as_unpaid')
                    ->hiddenLabel()
                    ->tooltip('Marcar como Pendente')
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
            ->toolbarActions([
                BulkActionGroup::make([
                    Action::make('mark_all_paid')
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
                            });
                        }),
                    Action::make('mark_all_unpaid')
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
            ->defaultPaginationPageOption(100)
            ->paginated([10, 25, 50, 100, 'all'])
            ->striped()
            ->emptyStateIcon('heroicon-o-presentation-chart-bar')
            ->emptyStateHeading('Nenhum extrato encontrado')
            ->emptyStateDescription('Crie uma nova conta para começar a gerar extratos.')
            ->emptyStateActions([
                Action::make('create_account')
                    ->label('Criar nova conta')
                    ->icon('heroicon-m-plus')
                    ->url('/accounts-receivables/create'),
            ]);
    }
}
