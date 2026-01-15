<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enum\Commission\CommissionStatusEnum;
use App\Models\Accounts\Accounts;
use App\Models\Accounts\AccountsInstallments;
use App\Models\Commission;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Str;

final class SaleObserver
{
    public static function generateAccountsReceivable(Sale $sale): ?Accounts
    {
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
                $product = Product::find($item->product_id);
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

        // Set completed_at if created with completed status
        if ($sale->status === 'completed' && ! $sale->completed_at) {
            $sale->completed_at = now();
        }
    }

    public function created(Sale $sale): void
    {
        // Generate commission if created with completed status
        if ($sale->status === 'completed' &&
            ! $sale->hasCommission() &&
            $sale->total > 0 &&
            $sale->user_id
        ) {
            $this->generateCommission($sale);
        }
    }

    public function updating(Sale $sale): void
    {
        if ($sale->isDirty('status') && $sale->status === 'completed') {
            $sale->completed_at = now();
        }
    }

    public function updated(Sale $sale): void
    {
        // Generate commission when status changes to completed
        if ($sale->wasChanged('status') &&
            $sale->status === 'completed' &&
            ! $sale->hasCommission() &&
            $sale->total > 0 &&
            $sale->user_id
        ) {
            $this->generateCommission($sale);
        }
    }

    private function generateCommission(Sale $sale): void
    {
        $user = $sale->user;

        if (! $user || $user->commission_percentage <= 0) {
            return;
        }

        Commission::query()->create([
            'tenant_id' => $sale->tenant_id,
            'user_id' => $sale->user_id,
            'sale_id' => $sale->id,
            'type' => 'sale',
            'commission_percentage' => $user->commission_percentage,
            'base_value' => $sale->total,
            'commission_amount' => ($sale->total * $user->commission_percentage) / 100,
            'status' => CommissionStatusEnum::PENDING,
        ]);
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
