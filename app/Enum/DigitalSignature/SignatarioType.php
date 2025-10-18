<?php

declare(strict_types=1);

namespace App\Enum\DigitalSignature;

enum SignatarioType: string
{
    case Signer = 'signer';
    case Witness = 'witness';
    case Approver = 'approver';

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->getLabel()])
            ->toArray();
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::Signer => 'Signatário',
            self::Witness => 'Testemunha',
            self::Approver => 'Aprovador',
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::Signer => 'Pessoa que deve assinar o documento',
            self::Witness => 'Pessoa que testemunha a assinatura',
            self::Approver => 'Pessoa que aprova o documento antes da assinatura',
        };
    }
}
