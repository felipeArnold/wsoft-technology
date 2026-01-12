<?php

declare(strict_types=1);

namespace App\Helpers;

use NumberFormatter;

abstract class FormatterHelper
{
    final public static function onlyNumbers(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return preg_replace('/\D/', '', (string) $value);
    }

    final public static function cpfCnpj(mixed $value): string
    {
        $value = self::onlyNumbers($value);

        if ($value) {
            if (mb_strlen($value) === 11) {
                return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value);
            }

            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $value);
        }

        return '';
    }

    final public static function toDecimal(null|string|int|float $value): float
    {
        if ($value === null || $value === '') {
            return 0.0;
        }
        if (is_numeric($value)) {
            return (float) $value;
        }

        return (float) str_replace(',', '.', str_replace('.', '', (string) $value));
    }

    final public static function cep(mixed $value): string
    {
        $value = self::onlyNumbers($value);

        if (mb_strlen($value) === 8) {
            return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $value);
        }

        return '';
    }

    final public static function money(mixed $value, bool $currency = false): string
    {
        // Converter para float primeiro para garantir compatibilidade com NumberFormatter
        $numericValue = self::toDecimal($value);

        $formatter = new NumberFormatter(
            'pt_BR',
            $currency
                ? NumberFormatter::CURRENCY
                : NumberFormatter::DECIMAL
        );
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);

        return $formatter->format($numericValue);
    }

    final public static function decimal(mixed $value, int $afterComma = 2): string
    {
        if (is_numeric($value) && floor($value) !== $value) {
            return $value;
        }

        if ($value === '' || is_null($value)) {
            $value = '0.00';
        }

        $value = str_replace(['.', ','], ['', '.'], $value);

        return number_format($value, $afterComma, '.', '');
    }

    final public static function phone(mixed $value): string
    {
        $value = self::onlyNumbers($value);

        if ($value) {
            if (mb_strlen($value) === 10) {
                return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $value);
            }

            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $value);
        }

        return '';
    }
}
