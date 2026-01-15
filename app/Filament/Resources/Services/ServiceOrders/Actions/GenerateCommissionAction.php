<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Actions;

use App\Enum\Commission\CommissionStatusEnum;
use App\Enum\ServiceOrderStatus;
use App\Models\Commission;
use App\Models\ServiceOrder;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;

final class GenerateCommissionAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Gerar Comissão')
            ->color(Color::Emerald)
            ->icon('heroicon-o-currency-dollar')
            ->modalHeading('Gerar Comissão')
            ->modalDescription(function () {
                /** @var ServiceOrder|null $record */
                $record = $this->getRecord();

                if (! $record || ! $record->userAssigned) {
                    return 'Configuração da comissão';
                }

                return "Gerar comissão para o técnico {$record->userAssigned->name} no valor de R$ ".number_format($record->labor_value, 2, ',', '.');
            })
            ->modalSubmitActionLabel('Gerar Comissão')
            ->modalWidth('md')
            ->requiresConfirmation()
            ->visible(function () {
                /** @var ServiceOrder|null $record */
                $record = $this->getRecord();

                if (! $record) {
                    return false;
                }

                return $record->status === ServiceOrderStatus::COMPLETED
                    && $record->labor_value > 0
                    && $record->assigned_user_id !== null
                    && ! $record->hasCommission();
            })
            ->action(fn () => $this->execute());
    }

    public static function make(?string $name = 'generate_commission'): static
    {
        return parent::make($name);
    }

    protected function execute(): void
    {
        /** @var ServiceOrder|null $record */
        $record = $this->getRecord();

        if (! $record) {
            Notification::make()
                ->title('Erro ao gerar comissão')
                ->body('Ordem de serviço não encontrada.')
                ->danger()
                ->send();

            return;
        }

        // Verify assigned user
        if (! $record->assigned_user_id) {
            Notification::make()
                ->title('Erro ao gerar comissão')
                ->body('A ordem de serviço não possui um responsável técnico.')
                ->danger()
                ->send();

            return;
        }

        // Verify user commission percentage
        $user = $record->userAssigned;
        if (! $user || $user->commission_percentage <= 0) {
            Notification::make()
                ->title('Erro ao gerar comissão')
                ->body('O responsável técnico não possui porcentagem de comissão configurada.')
                ->danger()
                ->send();

            return;
        }

        // Verify labor value
        if ($record->labor_value <= 0) {
            Notification::make()
                ->title('Erro ao gerar comissão')
                ->body('O valor de mão de obra deve ser maior que zero.')
                ->danger()
                ->send();

            return;
        }

        // Calculate commission amount
        $commissionAmount = ($record->labor_value * $user->commission_percentage) / 100;

        // Create commission
        Commission::query()->create([
            'tenant_id' => Filament::getTenant()->id,
            'user_id' => $record->assigned_user_id,
            'service_order_id' => $record->id,
            'type' => 'service_order',
            'commission_percentage' => $user->commission_percentage,
            'base_value' => $record->labor_value,
            'commission_amount' => $commissionAmount,
            'status' => CommissionStatusEnum::PENDING,
        ]);

        Notification::make()
            ->title('Comissão gerada com sucesso!')
            ->success()
            ->body('Comissão de R$ '.number_format($commissionAmount, 2, ',', '.')." ({$user->commission_percentage}%) gerada para {$user->name}.")
            ->send();
    }
}
