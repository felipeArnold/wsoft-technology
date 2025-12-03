<?php

declare(strict_types=1);

use App\Enum\AccountsReceivable\PaymentStatusEnum;

describe('PaymentStatusEnum', function () {
    it('has all expected cases', function () {
        $cases = PaymentStatusEnum::cases();

        expect($cases)->toHaveCount(5)
            ->and(in_array(PaymentStatusEnum::UNPAID, $cases, true))->toBeTrue()
            ->and(in_array(PaymentStatusEnum::PAID, $cases, true))->toBeTrue()
            ->and(in_array(PaymentStatusEnum::OVERDUE, $cases, true))->toBeTrue()
            ->and(in_array(PaymentStatusEnum::CANCELLED, $cases, true))->toBeTrue()
            ->and(in_array(PaymentStatusEnum::PARTIAL, $cases, true))->toBeTrue();
    });

    it('returns correct labels', function () {
        expect(PaymentStatusEnum::UNPAID->getLabel())->toBe('Em aberto')
            ->and(PaymentStatusEnum::PAID->getLabel())->toBe('Pago')
            ->and(PaymentStatusEnum::OVERDUE->getLabel())->toBe('Vencido')
            ->and(PaymentStatusEnum::CANCELLED->getLabel())->toBe('Cancelado')
            ->and(PaymentStatusEnum::PARTIAL->getLabel())->toBe('Parcial');
    });

    it('returns correct colors', function () {
        expect(PaymentStatusEnum::UNPAID->getColor())->toBe('warning')
            ->and(PaymentStatusEnum::PAID->getColor())->toBe('success')
            ->and(PaymentStatusEnum::OVERDUE->getColor())->toBe('danger')
            ->and(PaymentStatusEnum::CANCELLED->getColor())->toBe('gray')
            ->and(PaymentStatusEnum::PARTIAL->getColor())->toBe('info');
    });

    it('returns correct icons', function () {
        expect(PaymentStatusEnum::UNPAID->getIcon())->toBe('heroicon-o-clock')
            ->and(PaymentStatusEnum::PAID->getIcon())->toBe('heroicon-o-check-circle')
            ->and(PaymentStatusEnum::OVERDUE->getIcon())->toBe('heroicon-o-exclamation-triangle')
            ->and(PaymentStatusEnum::CANCELLED->getIcon())->toBe('heroicon-o-x-circle')
            ->and(PaymentStatusEnum::PARTIAL->getIcon())->toBe('heroicon-o-minus-circle');
    });

    it('has correct integer values', function () {
        expect(PaymentStatusEnum::UNPAID->value)->toBe(0)
            ->and(PaymentStatusEnum::PAID->value)->toBe(1)
            ->and(PaymentStatusEnum::OVERDUE->value)->toBe(2)
            ->and(PaymentStatusEnum::CANCELLED->value)->toBe(3)
            ->and(PaymentStatusEnum::PARTIAL->value)->toBe(4);
    });

    it('implements required interfaces', function () {
        expect(PaymentStatusEnum::UNPAID)
            ->toBeInstanceOf(Filament\Support\Contracts\HasLabel::class)
            ->toBeInstanceOf(Filament\Support\Contracts\HasColor::class)
            ->toBeInstanceOf(Filament\Support\Contracts\HasIcon::class);
    });
});
