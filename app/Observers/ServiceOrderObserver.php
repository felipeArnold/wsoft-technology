<?php

declare(strict_types=1);

namespace App\Observers;

use App\Helpers\FormatterHelper;
use App\Models\ServiceOrder;
use Illuminate\Support\Str;

final class ServiceOrderObserver
{
    public function creating(ServiceOrder $serviceOrder)
    {
        $lastOrder = ServiceOrder::query()->max('id');

        $serviceOrder->number = '#OS-'.now()->format('Y-m').'-'.Str::padLeft($lastOrder + 1, 3, '0');

        $values = [
            FormatterHelper::toDecimal($serviceOrder->labor_value),
            FormatterHelper::toDecimal($serviceOrder->parts_value),
        ];

        $serviceOrder->total_value = FormatterHelper::toDecimal(array_sum($values));
    }
}
