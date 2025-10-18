<?php

declare(strict_types=1);

namespace App\Enum\AccountsReceivable;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentMethodEnum: string implements HasColor, HasIcon, HasLabel
{
    case CASH = 'cash';
    case CREDIT = 'card';
    case PIX = 'pix';
    case BANK_TRANSFER = 'bank_transfer';
    case CHECK = 'check';
    case BOLETO = 'boleto';
    case DEBIT_CARD = 'debit_card';
    case CREDIT_CARD = 'credit_card';

    public function getLabel(): string
    {
        return match ($this) {
            self::CASH => 'Dinheiro',
            self::CREDIT => 'Cartão',
            self::PIX => 'PIX',
            self::BANK_TRANSFER => 'Transferência Bancária',
            self::CHECK => 'Cheque',
            self::BOLETO => 'Boleto',
            self::DEBIT_CARD => 'Cartão de Débito',
            self::CREDIT_CARD => 'Cartão de Crédito',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::CASH => 'success',
            self::CREDIT, self::CREDIT_CARD, self::DEBIT_CARD => 'primary',
            self::PIX => 'warning',
            self::BANK_TRANSFER => 'info',
            self::CHECK => 'secondary',
            self::BOLETO => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::CASH => 'heroicon-o-currency-dollar',
            self::CREDIT, self::CREDIT_CARD, self::DEBIT_CARD => 'heroicon-o-credit-card',
            self::PIX => 'heroicon-o-qr-code',
            self::BANK_TRANSFER => 'heroicon-o-building-library',
            self::CHECK => 'heroicon-o-document-text',
            self::BOLETO => 'heroicon-o-document-duplicate',
        };
    }
}
