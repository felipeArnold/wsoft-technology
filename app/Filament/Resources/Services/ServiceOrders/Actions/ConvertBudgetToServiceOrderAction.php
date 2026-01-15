<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Actions;

use App\Enum\ServiceOrderStatus;
use App\Models\ServiceOrder;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;

final class ConvertBudgetToServiceOrderAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Transformar em Ordem de Serviço')
            ->color(Color::Blue)
            ->icon('heroicon-o-arrow-right-circle')
            ->modalHeading('Transformar Orçamento em Ordem de Serviço')
            ->modalDescription('Confirme a conversão do orçamento para ordem de serviço:')
            ->modalSubmitActionLabel('Transformar')
            ->modalWidth('md')
            ->visible(function () {
                /** @var ServiceOrder|null $record */
                $record = $this->getRecord();

                if (! $record) {
                    return false;
                }

                return $record->status === ServiceOrderStatus::BUDGET;
            })
            ->requiresConfirmation()
            ->action(fn () => $this->execute());
    }

    public static function make(?string $name = 'convert_budget_to_service_order'): static
    {
        return parent::make($name);
    }

    protected function execute(): void
    {
        /** @var ServiceOrder|null $record */
        $record = $this->getRecord();

        if (! $record) {
            Notification::make()
                ->title('Erro')
                ->body('Orçamento não encontrado.')
                ->danger()
                ->send();

            return;
        }

        if ($record->status !== ServiceOrderStatus::BUDGET) {
            Notification::make()
                ->title('Erro')
                ->body('Este registro não é um orçamento.')
                ->danger()
                ->send();

            return;
        }

        // Update the status to convert budget to service order
        $record->update([
            'status' => ServiceOrderStatus::IN_PROGRESS,
        ]);

        Notification::make()
            ->title('Sucesso!')
            ->body('Orçamento transformado em Ordem de Serviço com sucesso.')
            ->success()
            ->send();
    }
}
