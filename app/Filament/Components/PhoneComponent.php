<?php

declare(strict_types=1);

namespace App\Filament\Components;

use Filament\Forms\Components\TextInput;
use Filament\Support\RawJs;
use Illuminate\Support\Str;

final class PhoneComponent extends TextInput
{
    protected function setUp(): void
    {
        $this
            ->inputMode('tel')
            ->maxLength(15)
            ->mask(RawJs::make(<<<'JS'
                (value) => {
                    if (value == null) return '';
                    value = String(value);

                    // mantém apenas dígitos
                    const digits = value.replace(/\D/g, '');
                    if (!digits.length) return '';

                    // formata o número de telefone
                    if (digits.length <= 10) {
                        // Formato (XX) XXXX-XXXX
                        return digits.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3').trim();
                    } else {
                        // Formato (XX) XXXXX-XXXX
                        return digits.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3').trim();
                    }
                }
            JS))
            ->default(null)
            ->dehydrateStateUsing(fn ($state) => self::toDigits($state))
            ->dehydrated(true)
            ->rule(['nullable']);
    }

    public static function toDigits(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return Str::of($value)
            ->replaceMatches('/\D/', '')
            ->toString();
    }
}
