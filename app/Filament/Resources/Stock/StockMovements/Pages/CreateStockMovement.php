<?php

declare(strict_types=1);

namespace App\Filament\Resources\Stock\StockMovements\Pages;

use App\Filament\Resources\Stock\StockMovements\StockMovementResource;
use App\Models\Product;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

final class CreateStockMovement extends CreateRecord
{
    protected static string $resource = StockMovementResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['tenant_id'] = Filament::getTenant()->id;
        $data['user_id'] = auth()->id();

        // Busca o produto para obter estoque atual
        $product = Product::find($data['product_id']);

        if ($product) {
            $data['stock_before'] = $product->stock;

            // Calcula estoque após movimentação
            $data['stock_after'] = match ($data['type']) {
                'in' => $product->stock + $data['quantity'],
                'out' => $product->stock - $data['quantity'],
                'adjustment' => $data['quantity'], // Para ajuste, a quantidade é o novo estoque
                default => $product->stock,
            };
        }

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $movement = parent::handleRecordCreation($data);

        // Atualiza o estoque do produto
        $product = Product::find($data['product_id']);

        if ($product) {
            $product->update(['stock' => $data['stock_after']]);

            // Se for entrada e tiver custo unitário, atualiza custo médio
            if ($data['type'] === 'in' && isset($data['unit_cost']) && $data['unit_cost'] > 0) {
                $this->updateAverageCost($product, $data['quantity'], $data['unit_cost']);
            }
        }

        return $movement;
    }

    protected function updateAverageCost(Product $product, int|float $quantity, float $unitCost): void
    {
        $quantity = (int) $quantity; // Garante que é inteiro
        $currentStock = $product->stock - $quantity; // Estoque antes da entrada
        $currentAverage = $product->average_cost ?? 0;

        // Calcula o custo médio ponderado
        $totalCost = ($currentStock * $currentAverage) + ($quantity * $unitCost);
        $newStock = $currentStock + $quantity;

        $newAverageCost = $newStock > 0 ? $totalCost / $newStock : 0;

        $product->update(['average_cost' => $newAverageCost]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Movimentação registrada com sucesso!';
    }
}
