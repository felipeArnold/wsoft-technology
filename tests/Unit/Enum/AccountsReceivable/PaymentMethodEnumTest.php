<?php

declare(strict_types=1);

namespace Tests\Unit\Enum\AccountsReceivable;

use App\Enum\AccountsReceivable\PaymentMethodEnum;
use PHPUnit\Framework\TestCase;
use ValueError;

/**
 * Testes unitários para PaymentMethodEnum
 * Foco: Performance e Segurança
 */
final class PaymentMethodEnumTest extends TestCase
{
    /**
     * @test
     * Segurança: Valida que todos os valores são strings válidas
     */
    public function it_has_valid_string_values(): void
    {
        $cases = PaymentMethodEnum::cases();

        foreach ($cases as $case) {
            $this->assertIsString($case->value, "Case {$case->name} deve ter valor string");
            $this->assertNotEmpty($case->value, "Case {$case->name} não pode ter valor vazio");

            // Segurança: Não deve conter caracteres especiais perigosos
            $this->assertDoesNotMatchRegularExpression(
                '/[<>"\']/',
                $case->value,
                "Case {$case->name} não deve conter caracteres perigosos (XSS)"
            );
        }
    }

    /**
     * @test
     * Segurança: Valida que não há valores duplicados
     */
    public function it_has_unique_values(): void
    {
        $values = array_map(fn ($case) => $case->value, PaymentMethodEnum::cases());
        $uniqueValues = array_unique($values);

        $this->assertCount(
            count($values),
            $uniqueValues,
            'Não deve haver valores duplicados no enum'
        );
    }

    /**
     * @test
     * Performance: Valida que getLabel() é rápido para todos os casos
     */
    public function get_label_is_performant(): void
    {
        $start = microtime(true);
        $iterations = 10000;

        for ($i = 0; $i < $iterations; $i++) {
            foreach (PaymentMethodEnum::cases() as $case) {
                $case->getLabel();
            }
        }

        $duration = microtime(true) - $start;

        // Deve executar 10k iterações em menos de 100ms
        $this->assertLessThan(
            0.1,
            $duration,
            "getLabel() deve ser performante (levou {$duration}s para {$iterations} iterações)"
        );
    }

    /**
     * @test
     * Performance: Valida que getColor() é rápido
     */
    public function get_color_is_performant(): void
    {
        $start = microtime(true);
        $iterations = 10000;

        for ($i = 0; $i < $iterations; $i++) {
            foreach (PaymentMethodEnum::cases() as $case) {
                $case->getColor();
            }
        }

        $duration = microtime(true) - $start;

        $this->assertLessThan(
            0.1,
            $duration,
            "getColor() deve ser performante (levou {$duration}s para {$iterations} iterações)"
        );
    }

    /**
     * @test
     * Performance: Valida que getIcon() é rápido
     */
    public function get_icon_is_performant(): void
    {
        $start = microtime(true);
        $iterations = 10000;

        for ($i = 0; $i < $iterations; $i++) {
            foreach (PaymentMethodEnum::cases() as $case) {
                $case->getIcon();
            }
        }

        $duration = microtime(true) - $start;

        $this->assertLessThan(
            0.1,
            $duration,
            "getIcon() deve ser performante (levou {$duration}s para {$iterations} iterações)"
        );
    }

    /**
     * @test
     * Segurança: Valida que todos os labels são seguros (sem HTML/JS)
     */
    public function labels_are_safe_from_xss(): void
    {
        foreach (PaymentMethodEnum::cases() as $case) {
            $label = $case->getLabel();

            $this->assertDoesNotMatchRegularExpression(
                '/<script|<iframe|javascript:|onerror=/i',
                $label,
                "Label do case {$case->name} não deve conter código malicioso"
            );

            // Valida que não há tags HTML
            $this->assertEquals(
                strip_tags($label),
                $label,
                "Label do case {$case->name} não deve conter tags HTML"
            );
        }
    }

    /**
     * @test
     * Segurança: Valida que cores retornadas são válidas
     */
    public function colors_are_valid_filament_colors(): void
    {
        $validColors = ['success', 'danger', 'warning', 'info', 'primary', 'secondary', 'gray'];

        foreach (PaymentMethodEnum::cases() as $case) {
            $color = $case->getColor();

            $this->assertContains(
                $color,
                $validColors,
                "Cor '{$color}' do case {$case->name} não é uma cor Filament válida"
            );
        }
    }

    /**
     * @test
     * Segurança: Valida que ícones retornados são válidos
     */
    public function icons_are_valid_heroicons(): void
    {
        foreach (PaymentMethodEnum::cases() as $case) {
            $icon = $case->getIcon();

            $this->assertStringStartsWith(
                'heroicon-',
                $icon,
                "Ícone '{$icon}' do case {$case->name} deve ser um Heroicon válido"
            );

            // Não deve conter caracteres perigosos
            $this->assertDoesNotMatchRegularExpression(
                '/[<>"\']/',
                $icon,
                "Ícone do case {$case->name} não deve conter caracteres perigosos"
            );
        }
    }

    /**
     * @test
     * Valida que todos os casos têm label, cor e ícone
     */
    public function all_cases_have_complete_implementation(): void
    {
        foreach (PaymentMethodEnum::cases() as $case) {
            $this->assertNotEmpty($case->getLabel(), "Case {$case->name} deve ter label");
            $this->assertNotEmpty($case->getColor(), "Case {$case->name} deve ter cor");
            $this->assertNotEmpty($case->getIcon(), "Case {$case->name} deve ter ícone");
        }
    }

    /**
     * @test
     * Segurança: Testa criação de enum a partir de valor
     */
    public function it_can_be_created_from_valid_value(): void
    {
        $this->assertEquals(PaymentMethodEnum::CASH, PaymentMethodEnum::from('cash'));
        $this->assertEquals(PaymentMethodEnum::PIX, PaymentMethodEnum::from('pix'));
        $this->assertEquals(PaymentMethodEnum::CREDIT_CARD, PaymentMethodEnum::from('credit_card'));
    }

    /**
     * @test
     * Segurança: Valida que valores inválidos lançam exceção
     */
    public function it_throws_exception_for_invalid_value(): void
    {
        $this->expectException(ValueError::class);
        PaymentMethodEnum::from('invalid_payment_method');
    }

    /**
     * @test
     * Segurança: tryFrom retorna null para valores inválidos sem lançar exceção
     */
    public function try_from_returns_null_for_invalid_value(): void
    {
        $this->assertNull(PaymentMethodEnum::tryFrom('invalid'));
        $this->assertNull(PaymentMethodEnum::tryFrom(''));
        $this->assertNull(PaymentMethodEnum::tryFrom('<script>alert("xss")</script>'));
    }

    /**
     * @test
     * Performance: Benchmark de criação de enum
     */
    public function enum_instantiation_is_fast(): void
    {
        $start = microtime(true);
        $iterations = 100000;

        for ($i = 0; $i < $iterations; $i++) {
            PaymentMethodEnum::tryFrom('pix');
        }

        $duration = microtime(true) - $start;

        // Deve executar 100k iterações em menos de 50ms
        $this->assertLessThan(
            0.05,
            $duration,
            "Criação de enum deve ser performante (levou {$duration}s para {$iterations} iterações)"
        );
    }

    /**
     * @test
     * Valida que o número de casos está correto (evita remoção acidental)
     */
    public function it_has_expected_number_of_cases(): void
    {
        $this->assertCount(8, PaymentMethodEnum::cases(), 'Deve ter exatamente 8 métodos de pagamento');
    }
}
