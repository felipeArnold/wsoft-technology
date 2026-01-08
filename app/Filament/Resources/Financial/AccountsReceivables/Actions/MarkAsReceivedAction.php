<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsReceivables\Actions;

use App\Models\Accounts\AccountsInstallments;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

final class MarkAsReceivedAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Marcar como Recebido')
            ->icon('heroicon-o-check-circle')
            ->color('success')
            ->hiddenLabel()
            ->tooltip('Marcar como recebido')
            ->visible(fn ($record) => ! $record->status->value)
            ->requiresConfirmation()
            ->modalHeading('Confirmar Recebimento')
            ->modalDescription('Deseja marcar esta parcela como recebida?')
            ->modalSubmitActionLabel('Confirmar')
            ->action(fn () => $this->execute());
    }

    public static function make(?string $name = 'mark_as_received'): static
    {
        return parent::make($name);
    }

    protected function execute(): void
    {
        /** @var AccountsInstallments|null $record */
        $record = $this->getRecord();

        if (! $record) {
            Notification::make()
                ->title('Erro')
                ->body('Parcela não encontrada.')
                ->danger()
                ->send();

            return;
        }

        // Marcar parcela como recebida
        $record->update([
            'status' => 1,
            'paid_at' => now(),
        ]);

        $account = $record->accounts;

        // Verificar se é conta recorrente e se é a última parcela
        if ($account && $account->recurring && $record->installment_number === $account->parcels) {
            $this->createRecurringInstallment($record, $account);
        }

        Notification::make()
            ->title('Parcela recebida!')
            ->body('A parcela foi marcada como recebida com sucesso.')
            ->success()
            ->send();
    }

    protected function createRecurringInstallment(AccountsInstallments $record, $account): void
    {
        $newDueDate = $record->due_date->copy()->addMonth();
        $newInstallmentAmount = $record->amount;

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
}
