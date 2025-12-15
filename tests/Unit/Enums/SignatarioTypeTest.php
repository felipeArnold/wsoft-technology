<?php

declare(strict_types=1);

use App\Enum\DigitalSignature\SignatarioType;

describe('SignatarioType', function (): void {
    it('has all expected cases', function (): void {
        $cases = SignatarioType::cases();

        expect($cases)->toHaveCount(3)
            ->and(in_array(SignatarioType::Signer, $cases, true))->toBeTrue()
            ->and(in_array(SignatarioType::Witness, $cases, true))->toBeTrue()
            ->and(in_array(SignatarioType::Approver, $cases, true))->toBeTrue();
    });

    it('returns correct labels', function (): void {
        expect(SignatarioType::Signer->getLabel())->toBe('Signatário')
            ->and(SignatarioType::Witness->getLabel())->toBe('Testemunha')
            ->and(SignatarioType::Approver->getLabel())->toBe('Aprovador');
    });

    it('returns correct descriptions', function (): void {
        expect(SignatarioType::Signer->getDescription())->toBe('Pessoa que deve assinar o documento')
            ->and(SignatarioType::Witness->getDescription())->toBe('Pessoa que testemunha a assinatura')
            ->and(SignatarioType::Approver->getDescription())->toBe('Pessoa que aprova o documento antes da assinatura');
    });

    it('has correct string values', function (): void {
        expect(SignatarioType::Signer->value)->toBe('signer')
            ->and(SignatarioType::Witness->value)->toBe('witness')
            ->and(SignatarioType::Approver->value)->toBe('approver');
    });

    it('returns options array with all cases', function (): void {
        $options = SignatarioType::options();

        expect($options)->toBeArray()
            ->toHaveCount(3)
            ->toHaveKey('signer')
            ->toHaveKey('witness')
            ->toHaveKey('approver')
            ->and($options['signer'])->toBe('Signatário')
            ->and($options['witness'])->toBe('Testemunha')
            ->and($options['approver'])->toBe('Aprovador');
    });

    it('can be instantiated from string value', function (): void {
        expect(SignatarioType::from('signer'))->toBe(SignatarioType::Signer)
            ->and(SignatarioType::from('witness'))->toBe(SignatarioType::Witness)
            ->and(SignatarioType::from('approver'))->toBe(SignatarioType::Approver);
    });

    it('returns null for invalid value using tryFrom', function (): void {
        expect(SignatarioType::tryFrom('invalid'))->toBeNull();
    });
});
