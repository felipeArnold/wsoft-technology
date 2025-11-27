<?php

declare(strict_types=1);

namespace App\Filament\Resources\Stock\StockInventories\Pages;

use App\Filament\Resources\Stock\StockInventories\StockInventoryResource;
use App\Models\StockMovement;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

final class EditStockInventory extends EditRecord
{
    protected static string $resource = StockInventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('start_inventory')
                ->label('Iniciar Inventário')
                ->icon('heroicon-o-play')
                ->color('warning')
                ->requiresConfirmation()
                ->visible(fn () => $this->record->status === 'draft')
                ->action(function () {
                    $this->record->update([
                        'status' => 'in_progress',
                        'started_at' => now(),
                    ]);

                    Notification::make()
                        ->success()
                        ->title('Inventário iniciado!')
                        ->send();
                }),

            Actions\Action::make('complete_inventory')
                ->label('Concluir Inventário')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalDescription('Ao concluir o inventário, as diferenças serão registradas como movimentações de ajuste de estoque. Esta ação não pode ser desfeita.')
                ->visible(fn () => $this->record->status === 'in_progress')
                ->action(function () {
                    $this->processInventoryCompletion();

                    Notification::make()
                        ->success()
                        ->title('Inventário concluído!')
                        ->body('As diferenças foram registradas como ajustes de estoque.')
                        ->send();
                }),

            Actions\Action::make('cancel_inventory')
                ->label('Cancelar Inventário')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn () => in_array($this->record->status, ['draft', 'in_progress']))
                ->action(function () {
                    $this->record->update([
                        'status' => 'cancelled',
                    ]);

                    Notification::make()
                        ->success()
                        ->title('Inventário cancelado!')
                        ->send();
                }),

            Actions\DeleteAction::make()
                ->visible(fn () => $this->record->status === 'draft'),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Se o status mudou para "in_progress" e ainda não foi iniciado
        if ($data['status'] === 'in_progress' && ! $this->record->started_at) {
            $data['started_at'] = now();
        }

        // Se o status mudou para "completed" e ainda não foi completado
        if ($data['status'] === 'completed' && ! $this->record->completed_at) {
            $data['completed_at'] = now();
        }

        return $data;
    }

    protected function processInventoryCompletion(): void
    {
        $this->record->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        // Processa cada item do inventário que tenha diferença
        foreach ($this->record->items as $item) {
            if ($item->difference !== 0 && $item->counted_quantity !== null) {
                // Busca o produto para obter o estoque atual
                $product = $item->product;

                // Cria movimentação de ajuste
                StockMovement::create([
                    'tenant_id' => $this->record->tenant_id,
                    'user_id' => auth()->id(),
                    'product_id' => $item->product_id,
                    'type' => 'adjustment',
                    'quantity' => $item->counted_quantity,
                    'stock_before' => $product->stock,
                    'stock_after' => $item->counted_quantity,
                    'reason' => 'Ajuste de inventário',
                    'notes' => "Inventário: {$this->record->reference} - Diferença: {$item->difference}",
                ]);

                // Atualiza estoque do produto
                $product->update([
                    'stock' => $item->counted_quantity,
                ]);
            }
        }
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Inventário atualizado com sucesso!';
    }
}
