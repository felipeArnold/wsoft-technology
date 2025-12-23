<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Pages;

use App\Filament\Resources\Services\ServiceOrders\ServiceOrderResource;
use App\Models\Accounts\Accounts;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Colors\Color;

final class EditServiceOrder extends EditRecord
{
    protected static string $resource = ServiceOrderResource::class;

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Ordem de serviço #'.$this->record->number.' atualizada com sucesso';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create_account_receivable')
                ->label('Gerar Conta a Receber')
                ->color(Color::Emerald)
                ->icon('heroicon-o-currency-dollar')
                ->modalHeading('Gerar Conta a Receber')
                ->modalDescription('Configure as parcelas e método de pagamento:')
                ->modalSubmitActionLabel('Gerar Conta')
                ->modalWidth('md')
                ->visible(fn () => $this->record->total_value > 0 && $this->record->person_id !== null)
                ->form([
                    Forms\Components\Select::make('parcels')
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
                        ->required(),
                    Forms\Components\TextInput::make('days_to_pay')
                        ->label('Dia do vencimento')
                        ->numeric()
                        ->default((int) now()->format('d'))
                        ->minValue(1)
                        ->maxValue(31)
                        ->maxLength(2)
                        ->required()
                        ->helperText('Dia do mês para vencimento das parcelas'),
                    Forms\Components\Select::make('payment_method')
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
                ->action(function (array $data): void {
                    // Create account receivable
                    $account = Accounts::query()->create([
                        'tenant_id' => Filament::getTenant()->id,
                        'user_id' => $this->record->user_id,
                        'person_id' => $this->record->person_id,
                        'service_order_id' => $this->record->id,
                        'type' => 'receivables',
                        'amount' => $this->record->total_value,
                        'parcels' => (int) $data['parcels'],
                        'days_to_pay' => (int) $data['days_to_pay'],
                        'status' => 'pending',
                        'payment_method' => $data['payment_method'],
                        'category' => 'Ordem de Serviço',
                        'reference_number' => $this->record->number ?? "OS-{$this->record->id}",
                        'notes' => $this->record->description,
                    ]);

                    // Create installments
                    $installmentsCount = (int) $data['parcels'];
                    $totalCents = (int) round($this->record->total_value * 100);
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

                    Notification::make()
                        ->title('Conta a receber criada com sucesso')
                        ->success()
                        ->body('A conta a receber foi gerada a partir da ordem de serviço.')
                        ->send();
                }),

            DeleteAction::make()
                ->label('Excluir Ordem')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->modalHeading('Excluir Ordem de Serviço')
                ->modalDescription('Tem certeza que deseja excluir esta ordem de serviço? Esta ação não pode ser desfeita.')
                ->modalSubmitActionLabel('Sim, excluir')
                ->successNotificationTitle('Ordem de serviço #'.$this->record->number.' excluída com sucesso'),
        ];
    }
}
