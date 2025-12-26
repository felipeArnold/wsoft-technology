<?php

declare(strict_types=1);

namespace App\Enum;

enum ServiceOrderStatus: string
{
    case DRAFT = 'draft';
    case BUDGET = 'budget';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public static function toSelectArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->getLabel()])
            ->toArray();
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::DRAFT => 'Rascunho',
            self::BUDGET => 'Orçamento',
            self::IN_PROGRESS => 'Em Andamento',
            self::COMPLETED => 'Concluída',
            self::CANCELLED => 'Cancelada',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::DRAFT => 'gray',
            self::BUDGET => 'info',
            self::IN_PROGRESS => 'warning',
            self::COMPLETED => 'success',
            self::CANCELLED => 'danger',
        };
    }

    public function getCalendarColor(): array
    {
        return match ($this) {
            self::DRAFT => ['bg' => '#64748b', 'border' => '#475569', 'text' => '#ffffff'],
            self::BUDGET => ['bg' => '#3b82f6', 'border' => '#2563eb', 'text' => '#ffffff'],
            self::IN_PROGRESS => ['bg' => '#f59e0b', 'border' => '#d97706', 'text' => '#ffffff'],
            self::COMPLETED => ['bg' => '#10b981', 'border' => '#059669', 'text' => '#ffffff'],
            self::CANCELLED => ['bg' => '#ef4444', 'border' => '#dc2626', 'text' => '#ffffff'],
        };
    }
}
