<?php

declare(strict_types=1);

use App\Enum\Template\TemplateContext;

describe('TemplateContext', function (): void {
    it('has all expected cases', function (): void {
        $cases = TemplateContext::cases();

        expect($cases)->toHaveCount(1)
            ->and(in_array(TemplateContext::ServiceOrder, $cases, true))->toBeTrue();
    });

    it('has correct string value', function (): void {
        expect(TemplateContext::ServiceOrder->value)->toBe('ServiceOrder');
    });

    it('can be instantiated from string value', function (): void {
        expect(TemplateContext::from('ServiceOrder'))->toBe(TemplateContext::ServiceOrder);
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
});
