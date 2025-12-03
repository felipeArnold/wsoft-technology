<?php

declare(strict_types=1);

use App\Enum\AccountsReceivable\PaymentMethodEnum;

describe('PaymentMethodEnum', function () {
    it('has all expected cases', function () {
        $cases = PaymentMethodEnum::cases();

        expect($cases)->toHaveCount(8)
            ->and(in_array(PaymentMethodEnum::CASH, $cases, true))->toBeTrue()
            ->and(in_array(PaymentMethodEnum::CREDIT, $cases, true))->toBeTrue()
            ->and(in_array(PaymentMethodEnum::PIX, $cases, true))->toBeTrue()
            ->and(in_array(PaymentMethodEnum::BANK_TRANSFER, $cases, true))->toBeTrue()
            ->and(in_array(PaymentMethodEnum::CHECK, $cases, true))->toBeTrue()
            ->and(in_array(PaymentMethodEnum::BOLETO, $cases, true))->toBeTrue()
            ->and(in_array(PaymentMethodEnum::DEBIT_CARD, $cases, true))->toBeTrue()
            ->and(in_array(PaymentMethodEnum::CREDIT_CARD, $cases, true))->toBeTrue();
    });

    it('returns correct labels', function () {
        expect(PaymentMethodEnum::CASH->getLabel())->toBe('Dinheiro')
            ->and(PaymentMethodEnum::CREDIT->getLabel())->toBe('Cartão')
            ->and(PaymentMethodEnum::PIX->getLabel())->toBe('PIX')
            ->and(PaymentMethodEnum::BANK_TRANSFER->getLabel())->toBe('Transferência Bancária')
            ->and(PaymentMethodEnum::CHECK->getLabel())->toBe('Cheque')
            ->and(PaymentMethodEnum::BOLETO->getLabel())->toBe('Boleto')
            ->and(PaymentMethodEnum::DEBIT_CARD->getLabel())->toBe('Cartão de Débito')
            ->and(PaymentMethodEnum::CREDIT_CARD->getLabel())->toBe('Cartão de Crédito');
    });

    it('returns correct colors', function () {
        expect(PaymentMethodEnum::CASH->getColor())->toBe('success')
            ->and(PaymentMethodEnum::CREDIT->getColor())->toBe('primary')
            ->and(PaymentMethodEnum::PIX->getColor())->toBe('warning')
            ->and(PaymentMethodEnum::BANK_TRANSFER->getColor())->toBe('info')
            ->and(PaymentMethodEnum::CHECK->getColor())->toBe('secondary')
            ->and(PaymentMethodEnum::BOLETO->getColor())->toBe('danger')
            ->and(PaymentMethodEnum::DEBIT_CARD->getColor())->toBe('primary')
            ->and(PaymentMethodEnum::CREDIT_CARD->getColor())->toBe('primary');
    });

    it('returns correct icons', function () {
        expect(PaymentMethodEnum::CASH->getIcon())->toBe('heroicon-o-currency-dollar')
            ->and(PaymentMethodEnum::CREDIT->getIcon())->toBe('heroicon-o-credit-card')
            ->and(PaymentMethodEnum::PIX->getIcon())->toBe('heroicon-o-qr-code')
            ->and(PaymentMethodEnum::BANK_TRANSFER->getIcon())->toBe('heroicon-o-building-library')
            ->and(PaymentMethodEnum::CHECK->getIcon())->toBe('heroicon-o-document-text')
            ->and(PaymentMethodEnum::BOLETO->getIcon())->toBe('heroicon-o-document-duplicate')
            ->and(PaymentMethodEnum::DEBIT_CARD->getIcon())->toBe('heroicon-o-credit-card')
            ->and(PaymentMethodEnum::CREDIT_CARD->getIcon())->toBe('heroicon-o-credit-card');
    });

    it('has correct string values', function () {
        expect(PaymentMethodEnum::CASH->value)->toBe('cash')
            ->and(PaymentMethodEnum::CREDIT->value)->toBe('card')
            ->and(PaymentMethodEnum::PIX->value)->toBe('pix')
            ->and(PaymentMethodEnum::BANK_TRANSFER->value)->toBe('bank_transfer')
            ->and(PaymentMethodEnum::CHECK->value)->toBe('check')
            ->and(PaymentMethodEnum::BOLETO->value)->toBe('boleto')
            ->and(PaymentMethodEnum::DEBIT_CARD->value)->toBe('debit_card')
            ->and(PaymentMethodEnum::CREDIT_CARD->value)->toBe('credit_card');
    });

    it('implements required interfaces', function () {
        expect(PaymentMethodEnum::CASH)
            ->toBeInstanceOf(Filament\Support\Contracts\HasLabel::class)
            ->toBeInstanceOf(Filament\Support\Contracts\HasColor::class)
            ->toBeInstanceOf(Filament\Support\Contracts\HasIcon::class);
    });
});
