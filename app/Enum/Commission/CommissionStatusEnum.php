<?php

declare(strict_types=1);

namespace App\Enum\Commission;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CommissionStatusEnum: string implements HasColor, HasIcon, HasLabel
{
    case PENDING = 'pending';
    case PAID = 'paid';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pendente',
            self::PAID => 'Pago',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::PAID => 'success',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::PENDING => 'heroicon-o-clock',
            self::PAID => 'heroicon-o-check-circle',
        };
    }
}
