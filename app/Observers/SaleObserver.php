<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Accounts\Accounts;
use App\Models\Accounts\AccountsInstallments;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Str;

final class SaleObserver
{
    public static function generateAccountsReceivable(Sale $sale): ?Accounts
    {
        if ($sale->total <= 0 || ! $sale->person_id) {
            return null;
        }

        $account = Accounts::create([
            'tenant_id' => $sale->tenant_id,
            'user_id' => $sale->user_id,
            'person_id' => $sale->person_id,
            'type' => 'receivables',
            'amount' => $sale->total,
            'parcels' => $sale->installments,
            'status' => 'pending',
            'payment_method' => match ($sale->payment_method) {
                'cash' => 'cash',
                'card' => 'card',
                'pix' => 'pix',
                default => 'cash',
            },
            'reference_number' => $sale->sale_number,
            'category' => 'Vendas',
            'notes' => "Conta gerada automaticamente da venda {$sale->sale_number}",
        ]);

        $installmentsCount = $sale->installments;
        $totalCents = (int) round($sale->total * 100);
        $baseCents = intdiv($totalCents, $installmentsCount);
        $firstCents = $totalCents - ($baseCents * ($installmentsCount - 1));

        for ($i = 0; $i < $installmentsCount; $i++) {
            $dueDate = Carbon::now()->addMonths($i);

            AccountsInstallments::create([
                'tenant_id' => $sale->tenant_id,
                'accounts_id' => $account->id,
                'installment_number' => $i + 1,
                'amount' => ($i === 0 ? $firstCents : $baseCents) / 100,
                'due_date' => $dueDate,
                'status' => 0,
            ]);
        }

        return $account;
    }

    public static function updateStock(Sale $sale): void
    {
        $sale->load('items');

        foreach ($sale->items as $item) {
            if ($item->product_id) {
                $product = \App\Models\Product::find($item->product_id);
                if ($product) {
                    $product->stock = max(0, $product->stock - $item->quantity);
                    $product->save();
                }
            }
        }
    }

    public function creating(Sale $sale): void
    {
        if (empty($sale->sale_number)) {
            $sale->sale_number = $this->generateSaleNumber($sale);
        }
    }

    public function updating(Sale $sale): void
    {
        if ($sale->isDirty('status') && $sale->status === 'completed') {
            $sale->completed_at = now();
        }
    }

    private function generateSaleNumber(Sale $sale): string
    {
        $lastSale = Sale::query()
            ->where('tenant_id', $sale->tenant_id)
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = $lastSale ? ((int) Str::afterLast($lastSale->sale_number, '-')) + 1 : 1;

        return 'VND-'.mb_str_pad((string) $nextNumber, 6, '0', STR_PAD_LEFT);
    }
}
