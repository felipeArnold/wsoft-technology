<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enum\Commission\CommissionStatusEnum;
use App\Helpers\FormatterHelper;
use App\Models\Commission;
use App\Models\ServiceOrder;
use Illuminate\Support\Str;

final class ServiceOrderObserver
{
    public function creating(ServiceOrder $serviceOrder)
    {
        // Generate order number based on current month
        $prefix = '#OS-'.now()->format('Y-m').'-';

        // Get the last order number for the current month
        $lastOrder = ServiceOrder::query()
            ->where('number', 'like', $prefix.'%')
            ->orderBy('number', 'desc')
            ->value('number');

        if ($lastOrder) {
            // Extract the sequential number from the last order
            $lastNumber = (int) mb_substr($lastOrder, -3);
            $nextNumber = $lastNumber + 1;
        } else {
            // First order of the month
            $nextNumber = 1;
        }

        $serviceOrder->number = $prefix.Str::padLeft($nextNumber, 3, '0');

        $values = [
            FormatterHelper::toDecimal($serviceOrder->labor_value),
            FormatterHelper::toDecimal($serviceOrder->parts_value),
        ];

        $serviceOrder->total_value = FormatterHelper::toDecimal(array_sum($values));
    }

    public function updated(ServiceOrder $serviceOrder): void
    {
        // Set completed_at timestamp when status changes to completed
        if ($serviceOrder->wasChanged('status') &&
            $serviceOrder->status === 'completed' &&
            ! $serviceOrder->completed_at
        ) {
            $serviceOrder->completed_at = now();
            $serviceOrder->saveQuietly();
        }

        // Generate commission when status changes to completed
        if ($serviceOrder->wasChanged('status') &&
            $serviceOrder->status === 'completed' &&
            ! $serviceOrder->hasCommission() &&
            $serviceOrder->labor_value > 0 &&
            $serviceOrder->assigned_user_id
        ) {
            $this->generateCommission($serviceOrder);
        }
    }

    private function generateCommission(ServiceOrder $serviceOrder): void
    {
        $user = $serviceOrder->userAssigned;

        if (! $user || $user->commission_percentage <= 0) {
            return;
        }

        Commission::query()->create([
            'tenant_id' => $serviceOrder->tenant_id,
            'user_id' => $serviceOrder->assigned_user_id,
            'service_order_id' => $serviceOrder->id,
            'commission_percentage' => $user->commission_percentage,
            'labor_value_base' => $serviceOrder->labor_value,
            'commission_amount' => ($serviceOrder->labor_value * $user->commission_percentage) / 100,
            'status' => CommissionStatusEnum::PENDING,
        ]);
    }
}
