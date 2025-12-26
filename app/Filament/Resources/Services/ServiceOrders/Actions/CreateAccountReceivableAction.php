<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Actions;

use App\Models\Accounts\Accounts;
use App\Models\ServiceOrder;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;

final class CreateAccountReceivableAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Gerar Conta a Receber')
            ->color(Color::Emerald)
            ->icon('heroicon-o-currency-dollar')
            ->modalHeading('Gerar Conta a Receber')
            ->modalDescription('Configure as parcelas e método de pagamento:')
            ->modalSubmitActionLabel('Gerar Conta')
            ->modalWidth('md')
            ->visible(function () {
                /** @var ServiceOrder|null $record */
                $record = $this->getRecord();

                if (! $record) {
                    return false;
                }

                return $record->total_value > 0 && $record->person_id !== null;
            })
            ->form($this->getFormSchema())
            ->action(fn (array $data) => $this->execute($data));
    }

    public static function make(?string $name = 'create_account_receivable'): static
    {
        return parent::make($name);
    }

    protected function getFormSchema(): array
    {
        return [
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
        ];
    }

    protected function execute(array $data): void
    {
        /** @var ServiceOrder|null $record */
        $record = $this->getRecord();

        if (! $record) {
            Notification::make()
                ->title('Erro')
                ->body('Ordem de serviço não encontrada.')
                ->danger()
                ->send();

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

        Notification::make()
            ->title('Conta a receber criada com sucesso')
            ->success()
            ->body('A conta a receber foi gerada a partir da ordem de serviço.')
            ->send();
    }
}
