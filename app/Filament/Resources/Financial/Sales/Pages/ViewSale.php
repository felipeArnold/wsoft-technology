<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Sales\Pages;

use App\Enum\Commission\CommissionStatusEnum;
use App\Filament\Resources\Financial\Sales\SaleResource;
use App\Models\Commission;
use App\Models\Sale;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

final class ViewSale extends ViewRecord
{
    protected static string $resource = SaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('generate_commission')
                ->label('Gerar Comissão')
                ->icon('heroicon-o-currency-dollar')
                ->color('success')
                ->visible(fn (Sale $record): bool => ! $record->hasCommission() && $record->status === 'completed')
                ->requiresConfirmation()
                ->modalHeading('Gerar Comissão')
                ->modalDescription(fn (Sale $record): string => "Gerar comissão para o vendedor {$record->user?->name} no valor total de R$ " . number_format($record->total, 2, ',', '.'))
                ->modalSubmitActionLabel('Gerar Comissão')
                ->action(function (Sale $record): void {
                    // Verificar se tem vendedor
                    if (! $record->user_id) {
                        Notification::make()
                            ->danger()
                            ->title('Erro ao gerar comissão')
                            ->body('A venda não possui um vendedor responsável.')
                            ->send();

                        return;
                    }

                    // Verificar se o vendedor tem porcentagem de comissão
                    $user = $record->user;
                    if (! $user || $user->commission_percentage <= 0) {
                        Notification::make()
                            ->danger()
                            ->title('Erro ao gerar comissão')
                            ->body('O vendedor não possui porcentagem de comissão configurada.')
                            ->send();

                        return;
                    }

                    // Verificar se o total é maior que zero
                    if ($record->total <= 0) {
                        Notification::make()
                            ->danger()
                            ->title('Erro ao gerar comissão')
                            ->body('O valor total da venda deve ser maior que zero.')
                            ->send();

                        return;
                    }

                    // Gerar comissão
                    $commissionAmount = ($record->total * $user->commission_percentage) / 100;

                    Commission::query()->create([
                        'tenant_id' => $record->tenant_id,
                        'user_id' => $record->user_id,
                        'sale_id' => $record->id,
                        'type' => 'sale',
                        'commission_percentage' => $user->commission_percentage,
                        'base_value' => $record->total,
                        'commission_amount' => $commissionAmount,
                        'status' => CommissionStatusEnum::PENDING,
                    ]);

                    Notification::make()
                        ->success()
                        ->title('Comissão gerada com sucesso!')
                        ->body("Comissão de R$ " . number_format($commissionAmount, 2, ',', '.') . " ({$user->commission_percentage}%) gerada para {$user->name}.")
                        ->send();
                }),
        ];
    }
}
