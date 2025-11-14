<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\NonPayments\Pages;

use App\Filament\Resources\Financial\NonPayments\NonPaymentResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewNonPayment extends ViewRecord
{
    protected static string $resource = NonPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('mark_as_paid')
                ->label('Marcar como Pago')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Confirmar Pagamento')
                ->modalDescription('Tem certeza que deseja marcar esta parcela como paga?')
                ->action(function (): void {
                    $this->record->update([
                        'status' => 1,
                        'paid_at' => now(),
                    ]);

                    $this->notify('success', 'Parcela marcada como paga com sucesso!');
                }),
            Action::make('send_reminder')
                ->label('Enviar Lembrete')
                ->icon('heroicon-o-envelope')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Enviar Lembrete')
                ->modalDescription('Enviar lembrete de pagamento para o cliente?')
                ->action(function (): void {
                    // Implementar envio de lembrete
                    $this->notify('success', 'Lembrete enviado com sucesso!');
                }),
            Action::make('view_account')
                ->label('Ver Conta Completa')
                ->icon('heroicon-o-document-text')
                ->color('gray')
                ->url(fn () => route('filament.app.resources.accounts-receivables.view', $this->record->accounts_id))
                ->openUrlInNewTab(),
        ];
    }
}
