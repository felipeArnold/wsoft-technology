<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsReceivables\Actions;

use App\Models\Accounts\AccountsInstallments;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

final class MarkAccountsInstallmentAsReceivedAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Marcar como Recebido')
            ->icon('heroicon-o-check-circle')
            ->color('success')
            ->visible(fn ($record) => ! $record->status->value)
            ->requiresConfirmation()
            ->action(fn () => self::execute($this->getRecord()));
    }

    public static function make(?string $name = 'mark_as_received'): static
    {
        return parent::make($name);
    }

    /**
     * Execute the action to mark an installment as received.
     */
    public static function execute(AccountsInstallments $installment): void
    {
        $installment->update([
            'status' => 1,
            'paid_at' => now(),
        ]);

        $account = $installment->accounts;

        // Handle recurring accounts - create next installment if this is the last one
        if ($account && $account->recurring && $installment->installment_number === $account->parcels) {
            static::createRecurringInstallment($installment, $account);
        }

        // Handle non-recurring accounts - mark as paid if all installments are paid
        if ($account && ! $account->recurring) {
            $allPaid = $account->installments()->where('status', 0)->doesntExist();

            if ($allPaid) {
                $account->update(['status' => 'paid']);
            }
        }

        Notification::make()
            ->title('Parcela marcada como recebida!')
            ->success()
            ->send();
    }

    /**
     * Create the next installment for recurring accounts.
     */
    private static function createRecurringInstallment(AccountsInstallments $installment, $account): void
    {
        $newDueDate = $installment->due_date->copy()->addMonth();
        $newInstallmentAmount = $installment->amount;

        // Reset the amount of the last paid installment
        $installment->update([
            'amount' => 0,
        ]);

        // Create new installment
        AccountsInstallments::create([
            'tenant_id' => $installment->tenant_id,
            'accounts_id' => $account->id,
            'installment_number' => $installment->installment_number + 1,
            'amount' => $newInstallmentAmount,
            'due_date' => $newDueDate,
            'status' => 0,
        ]);

        // Update account totals
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
