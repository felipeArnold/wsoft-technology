<?php

declare(strict_types=1);

namespace App\Filament\Components;

use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Support\RawJs;

final class PtbrMoney extends TextInput
{
    protected string|int|float|null $initialValue = '0,00';

    protected function setUp(): void
    {
        $this
            ->prefix('R$')
            ->inputMode('decimal')
            ->maxLength(20)
            ->mask(RawJs::make(<<<'JS'
                (value) => {
                    if (value == null) return '0,00';
                    value = String(value);

                    // mantém apenas dígitos
                    const digits = value.replace(/\D/g, '');
                    if (!digits.length) return '0,00';

                    // últimos 2 dígitos = centavos
                    const cents = Number.parseInt(digits, 10) / 100;

                    return new Intl.NumberFormat('pt-BR', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }).format(cents);
                }
            JS))
            ->stripCharacters('.')
            ->default(0.00)
            ->formatStateUsing(fn ($state) => $this->toPtBr($state))
            ->dehydrateStateUsing(fn ($state) => self::toDecimal($state))
            ->dehydrated(true)
            ->rule(['required']);
    }

    public static function toDecimal(null|string|int|float $value): float
    {
        if ($value === null || $value === '') {
            return 0.0;
        }
        if (is_numeric($value)) {
            return (float) $value;
        }

        return (float) str_replace(',', '.', str_replace('.', '', (string) $value));
    }

    /** opção para ligar/desligar a desidratação com conversão */
    public function dehydrateMask(bool|Closure $condition = true): static
    {
        if ($condition) {
            $this->dehydrateStateUsing(fn ($state) => $this->toDecimal($state));
        } else {
            $this->dehydrateStateUsing(null);
        }

        return $this;
    }

    public function initialValue(null|string|int|float|Closure $value = '0,00'): static
    {
        $this->initialValue = $value;

        return $this;
    }

    private function parseMoneyValue($value): float
    {
        if ($value === null || $value === '') {
            return 0.0;
        }

        // remove pontos de milhar e troca vírgula por ponto
        return (float) str_replace(',', '.', str_replace('.', '', $value));
    }

    /** 1234.56 -> "1.234,56" */
    private function toPtBr(mixed $state): string
    {
        if ($state === null || $state === '') {
            return (string) $this->initialValue;
        }

        $value = is_numeric($state)
            ? (float) $state
            : (float) str_replace(',', '.', (string) $state);

        return number_format($value, 2, ',', '.');
    }
}
