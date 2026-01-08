<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsReceivables\Actions;

use App\Models\Accounts\AccountsInstallments;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;

final class MarkAllAsReceivedBulkAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Marcar como Recebido')
            ->icon('heroicon-o-check-circle')
            ->color('success')
            ->requiresConfirmation()
            ->modalHeading('Confirmar Recebimento em Massa')
            ->modalDescription('Deseja marcar todas as parcelas selecionadas como recebidas?')
            ->modalSubmitActionLabel('Confirmar')
            ->accessSelectedRecords()
            ->action(fn (Collection $records) => $this->execute($records));
    }

    public static function make(?string $name = 'mark_all_received'): static
    {
        return parent::make($name);
    }

    protected function execute(Collection $records): void
    {
        if ($records->isEmpty()) {
            Notification::make()
                ->title('Erro')
                ->body('Nenhuma parcela selecionada.')
                ->danger()
                ->send();

            return;
        }

        $processedCount = 0;
        $recurringCount = 0;

        $records->each(function ($record) use (&$processedCount, &$recurringCount): void {
            // Marcar parcela como recebida
            $record->update([
                'status' => 1,
                'paid_at' => now(),
            ]);

            $processedCount++;

            $account = $record->accounts;

            // Verificar se é conta recorrente e se é a última parcela
            if ($account && $account->recurring && $record->installment_number === $account->parcels) {
                $this->createRecurringInstallment($record, $account);
                $recurringCount++;
            }
        });

        // Notificação de sucesso
        $message = "Foram marcadas {$processedCount} parcela(s) como recebida(s).";

        if ($recurringCount > 0) {
            $message .= " {$recurringCount} nova(s) parcela(s) recorrente(s) foi(ram) criada(s).";
        }

        Notification::make()
            ->title('Parcelas recebidas!')
            ->body($message)
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
    }
}
