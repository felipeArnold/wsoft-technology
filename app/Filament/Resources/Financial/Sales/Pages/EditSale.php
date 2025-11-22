<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Sales\Pages;

use App\Filament\Resources\Financial\Sales\SaleResource;
use App\Helpers\FormatterHelper;
use App\Observers\SaleObserver;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

final class EditSale extends EditRecord
{
    protected static string $resource = SaleResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['subtotal'] = FormatterHelper::toDecimal($data['subtotal'] ?? 0);
        $data['discount_amount'] = FormatterHelper::toDecimal($data['discount_amount'] ?? 0);
        $data['total'] = FormatterHelper::toDecimal($data['total'] ?? 0);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('finalize')
                ->label('Finalizar e Gerar Contas a Receber')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => $this->record->status !== 'completed')
                ->requiresConfirmation()
                ->modalHeading('Finalizar Venda')
                ->modalDescription('Ao finalizar a venda, será gerada automaticamente uma conta a receber. Deseja continuar?')
                ->modalSubmitActionLabel('Sim, finalizar')
                ->action(function (): void {
                    $sale = $this->record;

                    if (! $sale->person_id) {
                        Notification::make()
                            ->title('Cliente obrigatório')
                            ->body('É necessário informar um cliente para gerar a conta a receber.')
                            ->danger()
                            ->send();

                        return;
                    }

                    $sale->status = 'completed';
                    $sale->save();

                    $account = SaleObserver::generateAccountsReceivable($sale);

                    SaleObserver::updateStock($sale);

                    if ($account) {
                        Notification::make()
                            ->title('Venda finalizada!')
                            ->body('Conta a receber gerada e estoque atualizado com sucesso.')
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Venda finalizada!')
                            ->body('Estoque atualizado. Conta a receber não gerada (valor zero ou cliente não informado).')
                            ->warning()
                            ->send();
                    }

                    $this->refreshFormData(['status', 'completed_at']);
                }),
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
