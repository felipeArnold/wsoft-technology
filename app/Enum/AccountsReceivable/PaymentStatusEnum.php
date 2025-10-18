<?php

declare(strict_types=1);

namespace App\Enum\AccountsReceivable;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatusEnum: int implements HasColor, HasIcon, HasLabel
{
    case UNPAID = 0;
    case PAID = 1;
    case OVERDUE = 2;
    case CANCELLED = 3;
    case PARTIAL = 4;

    public function getLabel(): string
    {
        return match ($this) {
            self::UNPAID => 'Em aberto',
            self::PAID => 'Pago',
            self::OVERDUE => 'Vencido',
            self::CANCELLED => 'Cancelado',
            self::PARTIAL => 'Parcial',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::UNPAID => 'warning',
            self::PAID => 'success',
            self::OVERDUE => 'danger',
            self::CANCELLED => 'gray',
            self::PARTIAL => 'info',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::UNPAID => 'heroicon-o-clock',
            self::PAID => 'heroicon-o-check-circle',
            self::OVERDUE => 'heroicon-o-exclamation-triangle',
            self::CANCELLED => 'heroicon-o-x-circle',
            self::PARTIAL => 'heroicon-o-minus-circle',
        };
    }
}
