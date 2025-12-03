<?php

declare(strict_types=1);

use App\Enum\Template\TemplateContext;

describe('TemplateContext', function () {
    it('has all expected cases', function () {
        $cases = TemplateContext::cases();

        expect($cases)->toHaveCount(1)
            ->and(in_array(TemplateContext::ServiceOrder, $cases, true))->toBeTrue();
    });

    it('has correct string value', function () {
        expect(TemplateContext::ServiceOrder->value)->toBe('ServiceOrder');
    });

    it('can be instantiated from string value', function () {
        expect(TemplateContext::from('ServiceOrder'))->toBe(TemplateContext::ServiceOrder);
    });

    it('returns null for invalid value using tryFrom', function () {
        expect(TemplateContext::tryFrom('InvalidContext'))->toBeNull();
    });

    it('can be compared using strict equality', function () {
        $context1 = TemplateContext::ServiceOrder;
        $context2 = TemplateContext::from('ServiceOrder');

        expect($context1)->toBe($context2)
            ->and($context1 === $context2)->toBeTrue();
    });
});
