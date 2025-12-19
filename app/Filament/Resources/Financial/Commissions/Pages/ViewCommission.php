<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Commissions\Pages;

use App\Filament\Resources\Financial\Commissions\CommissionResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ViewRecord;

final class ViewCommission extends ViewRecord
{
    protected static string $resource = CommissionResource::class;

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
                ->modalDescription('Tem certeza que deseja marcar esta comissão como paga?')
                ->action(function () {
                    $currentUser = Filament::auth()->user();
                    $this->record->markAsPaid($currentUser);
                    $this->refreshFormData(['status', 'paid_at', 'paid_by_user_id']);
                })
                ->visible(fn () => $this->record->isPending()),
            Action::make('mark_as_pending')
                ->label('Marcar como Pendente')
                ->icon('heroicon-o-clock')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Confirmar Alteração')
                ->modalDescription('Tem certeza que deseja marcar esta comissão como pendente?')
                ->action(function () {
                    $this->record->markAsPending();
                    $this->refreshFormData(['status', 'paid_at', 'paid_by_user_id']);
                })
                ->visible(fn () => $this->record->isPaid()),
        ];
    }
}
