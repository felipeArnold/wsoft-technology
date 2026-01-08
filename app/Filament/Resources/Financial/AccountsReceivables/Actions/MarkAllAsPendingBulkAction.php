<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsReceivables\Actions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;

final class MarkAllAsPendingBulkAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Marcar como Pendente')
            ->icon('heroicon-o-x-circle')
            ->color('warning')
            ->requiresConfirmation()
            ->modalHeading('Marcar como Pendente em Massa')
            ->modalDescription('Deseja marcar todas as parcelas selecionadas como pendentes?')
            ->modalSubmitActionLabel('Confirmar')
            ->accessSelectedRecords()
            ->action(fn (Collection $records) => $this->execute($records));
    }

    public static function make(?string $name = 'mark_all_pending'): static
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

        $count = 0;

        $records->each(function ($record) use (&$count): void {
            $record->update([
                'status' => 0,
                'paid_at' => null,
            ]);

            $count++;
        });

        Notification::make()
            ->title('Parcelas atualizadas!')
            ->body("Foram marcadas {$count} parcela(s) como pendente(s).")
            ->success()
            ->send();
    }
}
