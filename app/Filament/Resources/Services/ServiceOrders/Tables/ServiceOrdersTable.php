<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Models\Accounts\Accounts;
use App\Models\ServiceOrder;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

final class ServiceOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(ServiceOrder::getTableColumns())
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Rascunho',
                        'in_progress' => 'Em Andamento',
                        'completed' => 'Concluída',
                        'cancelled' => 'Cancelada',
                    ]),
                SelectFilter::make('priority')
                    ->label('Prioridade')
                    ->options([
                        'low' => 'Baixa',
                        'medium' => 'Média',
                        'high' => 'Alta',
                        'urgent' => 'Urgente',
                    ]),
                SelectFilter::make('categories')
                    ->label('Etiquetas')
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->multiple()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                //                Action::make('create_account_receivable')
                //                    ->label('Gerar Conta a Receber')
                //                    ->icon('heroicon-o-currency-dollar')
                //                    ->modalWidth('md')
                //                    ->color('success')
                //                    ->visible(fn (ServiceOrder $record) => $record->total_value > 0 && $record->person_id !== null)
                //                    ->form([
                //                        Select::make('parcels')
                //                            ->label('Parcelas')
                //                            ->options([
                //                                '1' => 'À vista',
                //                                '2' => '2x',
                //                                '3' => '3x',
                //                                '4' => '4x',
                //                                '5' => '5x',
                //                                '6' => '6x',
                //                                '7' => '7x',
                //                                '8' => '8x',
                //                                '9' => '9x',
                //                                '10' => '10x',
                //                                '12' => '12x',
                //                            ])
                //                            ->default('1')
                //                            ->native(false)
                //                            ->required(),
                //                        TextInput::make('days_to_pay')
                //                            ->label('Dia do vencimento')
                //                            ->numeric()
                //                            ->default((int) now()->format('d'))
                //                            ->minValue(1)
                //                            ->maxValue(31)
                //                            ->maxLength(2)
                //                            ->required(),
                //                        Select::make('payment_method')
                //                            ->label('Método de pagamento')
                //                            ->options([
                //                                'cash' => 'Dinheiro',
                //                                'card' => 'Cartão',
                //                                'pix' => 'PIX',
                //                                'bank_transfer' => 'Transferência Bancária',
                //                                'check' => 'Cheque',
                //                                'boleto' => 'Boleto',
                //                                'debit_card' => 'Cartão de Débito',
                //                                'credit_card' => 'Cartão de Crédito',
                //                            ])
                //                            ->default('pix')
                //                            ->native(false)
                //                            ->required(),
                //                    ])
                //                    ->action(function (array $data, ServiceOrder $record): void {
                //                        // Create account receivable
                //                        $account = Accounts::query()->create([
                //                            'tenant_id' => Filament::getTenant()->id,
                //                            'user_id' => $record->user_id,
                //                            'person_id' => $record->person_id,
                //                            'service_order_id' => $record->id,
                //                            'type' => 'receivables',
                //                            'amount' => $record->total_value,
                //                            'parcels' => (int) $data['parcels'],
                //                            'days_to_pay' => (int) $data['days_to_pay'],
                //                            'status' => 'pending',
                //                            'payment_method' => $data['payment_method'],
                //                            'category' => 'Ordem de Serviço',
                //                            'reference_number' => $record->number ?? "OS-{$record->id}",
                //                            'notes' => $record->description,
                //                        ]);
                //
                //                        // Create installments
                //                        $installmentsCount = (int) $data['parcels'];
                //                        $totalCents = (int) round($record->total_value * 100);
                //                        $baseCents = intdiv($totalCents, $installmentsCount);
                //                        $firstCents = $totalCents - ($baseCents * ($installmentsCount - 1));
                //                        $dayOfMonth = (int) $data['days_to_pay'];
                //
                //                        for ($i = 0; $i < $installmentsCount; $i++) {
                //                            $dueDate = now()
                //                                ->copy()
                //                                ->startOfMonth()
                //                                ->addMonths($i)
                //                                ->day($dayOfMonth);
                //
                //                            $account->installments()->create([
                //                                'tenant_id' => Filament::getTenant()->id,
                //                                'installment_number' => $i + 1,
                //                                'amount' => ($i === 0 ? $firstCents : $baseCents) / 100,
                //                                'due_date' => $dueDate,
                //                                'status' => 0,
                //                            ]);
                //                        }
                //
                //                        Notification::make()
                //                            ->title('Conta a receber criada com sucesso')
                //                            ->success()
                //                            ->body('A conta a receber foi gerada a partir da ordem de serviço.')
                //                            ->send();
                //                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    Action::make('update_priority')
                        ->label('Atualizar Prioridade')
                        ->icon('heroicon-o-pencil-square')
                        ->modalWidth('md')
                        ->requiresConfirmation()
                        ->color('warning')
                        ->accessSelectedRecords()
                        ->form([
                            Select::make('priority')
                                ->label('Prioridade')
                                ->options([
                                    'low' => 'Baixa',
                                    'medium' => 'Média',
                                    'high' => 'Alta',
                                    'urgent' => 'Urgente',
                                ])
                                ->native(false)
                                ->required(),
                        ])
                        ->action(function (array $data, Collection $records): void {
                            $records->each(function (ServiceOrder $record) use ($data): void {
                                $record->update([
                                    'priority' => $data['priority'],
                                ]);
                            });

                            Notification::make()
                                ->title('Prioridade atualizada com sucesso')
                                ->success()
                                ->body('A prioridade das ordens de serviço selecionadas foi atualizada.')
                                ->send();
                        }),
                    Action::make('update_status')
                        ->label('Atualizar Status')
                        ->icon('heroicon-o-arrow-path')
                        ->modalWidth('md')
                        ->requiresConfirmation()
                        ->color('info')
                        ->accessSelectedRecords()
                        ->form([
                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'draft' => 'Rascunho',
                                    'in_progress' => 'Em Andamento',
                                    'completed' => 'Concluída',
                                    'cancelled' => 'Cancelada',
                                ])
                                ->native(false)
                                ->required(),
                        ])
                        ->action(function (array $data, Collection $records): void {
                            $records->each(function (ServiceOrder $record) use ($data): void {
                                $record->update([
                                    'status' => $data['status'],
                                ]);
                            });

                            Notification::make()
                                ->title('Status atualizado com sucesso')
                                ->success()
                                ->body('O status das ordens de serviço selecionadas foi atualizado.')
                                ->send();
                        }),
                    Action::make('update_responsible')
                        ->label('Atualizar Responsável')
                        ->icon('heroicon-o-user')
                        ->modalWidth('md')
                        ->requiresConfirmation()
                        ->color('success')
                        ->accessSelectedRecords()
                        ->form([
                            Select::make('user_id')
                                ->label('Responsável')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),
                        ])
                        ->action(function (array $data, Collection $records): void {
                            $records->each(function (ServiceOrder $record) use ($data): void {
                                $record->update([
                                    'user_id' => $data['user_id'],
                                ]);
                            });

                            Notification::make()
                                ->title('Responsável atualizado com sucesso')
                                ->success()
                                ->body('O responsável das ordens de serviço selecionadas foi atualizado.')
                                ->send();
                        }),
                    Action::make('create_account_receivable')
                        ->label('Gerar Conta a Receber')
                        ->icon('heroicon-o-currency-dollar')
                        ->modalWidth('md')
                        ->requiresConfirmation()
                        ->color('success')
                        ->accessSelectedRecords()
                        ->form([
                            Select::make('parcels')
                                ->label('Parcelas')
                                ->options([
                                    '1' => 'À vista',
                                    '2' => '2x',
                                    '3' => '3x',
                                    '4' => '4x',
                                    '5' => '5x',
                                    '6' => '6x',
                                    '7' => '7x',
                                    '8' => '8x',
                                    '9' => '9x',
                                    '10' => '10x',
                                    '12' => '12x',
                                ])
                                ->default('1')
                                ->native(false)
                                ->required()
                                ->helperText('Número de parcelas para cada conta a receber'),
                            TextInput::make('days_to_pay')
                                ->label('Dia do vencimento')
                                ->numeric()
                                ->default((int) now()->format('d'))
                                ->minValue(1)
                                ->maxValue(31)
                                ->maxLength(2)
                                ->required()
                                ->helperText('Dia do mês para vencimento das parcelas'),
                            Select::make('payment_method')
                                ->label('Método de pagamento')
                                ->options([
                                    'cash' => 'Dinheiro',
                                    'card' => 'Cartão',
                                    'pix' => 'PIX',
                                    'bank_transfer' => 'Transferência Bancária',
                                    'check' => 'Cheque',
                                    'boleto' => 'Boleto',
                                    'debit_card' => 'Cartão de Débito',
                                    'credit_card' => 'Cartão de Crédito',
                                ])
                                ->default('pix')
                                ->native(false)
                                ->required(),
                        ])
                        ->action(function (array $data, Collection $records): void {
                            $createdCount = 0;
                            $skippedCount = 0;

                            $records->each(function (ServiceOrder $record) use ($data, &$createdCount, &$skippedCount): void {
                                // Skip if no total value or no person
                                if (! $record->total_value || $record->total_value <= 0 || ! $record->person_id) {
                                    $skippedCount++;

                                    return;
                                }

                                // Create account receivable
                                $account = Accounts::query()->create([
                                    'tenant_id' => Filament::getTenant()->id,
                                    'user_id' => $record->user_id,
                                    'person_id' => $record->person_id,
                                    'service_order_id' => $record->id,
                                    'type' => 'receivables',
                                    'amount' => $record->total_value,
                                    'parcels' => (int) $data['parcels'],
                                    'days_to_pay' => (int) $data['days_to_pay'],
                                    'status' => 'pending',
                                    'payment_method' => $data['payment_method'],
                                    'category' => 'Ordem de Serviço',
                                    'reference_number' => $record->number ?? "OS-{$record->id}",
                                    'notes' => $record->description,
                                ]);

                                // Create installments
                                $installmentsCount = (int) $data['parcels'];
                                $totalCents = (int) round($record->total_value * 100);
                                $baseCents = intdiv($totalCents, $installmentsCount);
                                $firstCents = $totalCents - ($baseCents * ($installmentsCount - 1));
                                $dayOfMonth = (int) $data['days_to_pay'];

                                for ($i = 0; $i < $installmentsCount; $i++) {
                                    $dueDate = now()
                                        ->copy()
                                        ->startOfMonth()
                                        ->addMonths($i)
                                        ->day($dayOfMonth);

                                    $account->installments()->create([
                                        'tenant_id' => Filament::getTenant()->id,
                                        'installment_number' => $i + 1,
                                        'amount' => ($i === 0 ? $firstCents : $baseCents) / 100,
                                        'due_date' => $dueDate,
                                        'status' => 0,
                                    ]);
                                }

                                $createdCount++;
                            });

                            if ($createdCount > 0) {
                                Notification::make()
                                    ->title('Contas a receber criadas com sucesso')
                                    ->success()
                                    ->body("{$createdCount} conta(s) a receber gerada(s) a partir das ordens de serviço selecionadas.".($skippedCount > 0 ? " {$skippedCount} ordem(ns) ignorada(s) (sem valor ou sem cliente)." : ''))
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Nenhuma conta criada')
                                    ->warning()
                                    ->body('As ordens selecionadas não possuem valor total ou cliente definido.')
                                    ->send();
                            }
                        }),
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-clipboard-document-list')
            ->emptyStateHeading('Nenhuma ordem de serviço encontrada')
            ->emptyStateDescription('Crie sua primeira ordem de serviço para começar a gerenciar os serviços.');
    }
}
