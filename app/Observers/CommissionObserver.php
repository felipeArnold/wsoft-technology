<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Commission;
use Exception;
use Filament\Facades\Filament;

final class CommissionObserver
{
    public function creating(Commission $commission): void
    {
        if (! $commission->tenant_id && Filament::getTenant()) {
            $commission->tenant_id = Filament::getTenant()->id;
        }
    }

    public function updating(Commission $commission): void
    {
        if ($commission->isDirty(['commission_percentage', 'labor_value_base', 'commission_amount'])) {
            throw new Exception('Não é permitido alterar os campos de cálculo da comissão após a criação.');
        }
    }
}
