<?php

declare(strict_types=1);

use App\Enum\Template\TemplateContext;

describe('TemplateContext', function (): void {
    it('has all expected cases', function (): void {
        $cases = TemplateContext::cases();

        expect($cases)->toHaveCount(4)
            ->and(in_array(TemplateContext::ServiceOrder, $cases, true))->toBeTrue()
            ->and(in_array(TemplateContext::AccountsPayable, $cases, true))->toBeTrue()
            ->and(in_array(TemplateContext::AccountsReceivable, $cases, true))->toBeTrue()
            ->and(in_array(TemplateContext::Overdue, $cases, true))->toBeTrue();
    });

    it('has correct string values', function (): void {
        expect(TemplateContext::ServiceOrder->value)->toBe('ServiceOrder')
            ->and(TemplateContext::AccountsPayable->value)->toBe('AccountsPayable')
            ->and(TemplateContext::AccountsReceivable->value)->toBe('AccountsReceivable')
            ->and(TemplateContext::Overdue->value)->toBe('Overdue');
    });

    it('can be instantiated from string value', function (): void {
        expect(TemplateContext::from('ServiceOrder'))->toBe(TemplateContext::ServiceOrder)
            ->and(TemplateContext::from('AccountsPayable'))->toBe(TemplateContext::AccountsPayable)
            ->and(TemplateContext::from('AccountsReceivable'))->toBe(TemplateContext::AccountsReceivable)
            ->and(TemplateContext::from('Overdue'))->toBe(TemplateContext::Overdue);
    });

    it('returns null for invalid value using tryFrom', function (): void {
        expect(TemplateContext::tryFrom('InvalidContext'))->toBeNull();
    });

    it('can be compared using strict equality', function (): void {
        $context1 = TemplateContext::ServiceOrder;
        $context2 = TemplateContext::from('ServiceOrder');

        expect($context1)->toBe($context2)
            ->and($context1 === $context2)->toBeTrue();
    });

    it('returns correct labels', function (): void {
        expect(TemplateContext::ServiceOrder->getLabel())->toBe('Ordem de Serviço')
            ->and(TemplateContext::AccountsPayable->getLabel())->toBe('Contas a Pagar')
            ->and(TemplateContext::AccountsReceivable->getLabel())->toBe('Contas a Receber')
            ->and(TemplateContext::Overdue->getLabel())->toBe('Inadimplência');
    });

    it('returns correct colors', function (): void {
        expect(TemplateContext::ServiceOrder->getColor())->toBe('info')
            ->and(TemplateContext::AccountsPayable->getColor())->toBe('warning')
            ->and(TemplateContext::AccountsReceivable->getColor())->toBe('success')
            ->and(TemplateContext::Overdue->getColor())->toBe('danger');
    });
});
