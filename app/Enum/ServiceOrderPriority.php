<?php

declare(strict_types=1);

namespace App\Enum;

enum ServiceOrderPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case URGENT = 'urgent';

    public static function toSelectArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->getLabel()])
            ->toArray();
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::LOW => 'Baixa',
            self::MEDIUM => 'Média',
            self::HIGH => 'Alta',
            self::URGENT => 'Urgente',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::LOW => 'gray',
            self::MEDIUM => 'info',
            self::HIGH => 'warning',
            self::URGENT => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::URGENT => '🔴 ',
            self::HIGH => '🟠 ',
            self::MEDIUM => '🟡 ',
            self::LOW => '🟢 ',
        };
    }

    public function getBorderWidth(): string
    {
        return match ($this) {
            self::URGENT => '4px',
            self::HIGH => '3px',
            self::MEDIUM => '2px',
            self::LOW => '1px',
        };
    }
}
