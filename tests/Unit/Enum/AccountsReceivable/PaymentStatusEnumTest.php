<?php

declare(strict_types=1);

namespace Tests\Unit\Enum\AccountsReceivable;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use PHPUnit\Framework\TestCase;
use ValueError;

/**
 * Testes unitários para PaymentStatusEnum
 * Foco: Performance e Segurança
 */
final class PaymentStatusEnumTest extends TestCase
{
    /**
     * @test
     * Segurança: Valida que todos os valores são inteiros válidos
     */
    public function it_has_valid_integer_values(): void
    {
        $cases = PaymentStatusEnum::cases();

        foreach ($cases as $case) {
            $this->assertIsInt($case->value, "Case {$case->name} deve ter valor inteiro");
            $this->assertGreaterThanOrEqual(0, $case->value, "Case {$case->name} deve ter valor >= 0");
        }
    }

    /**
     * @test
     * Segurança: Valida que não há valores duplicados
     */
    public function it_has_unique_values(): void
    {
        $values = array_map(fn ($case) => $case->value, PaymentStatusEnum::cases());
        $uniqueValues = array_unique($values);

        $this->assertCount(
            count($values),
            $uniqueValues,
            'Não deve haver valores duplicados no enum'
        );
    }

    /**
     * @test
     * Segurança: Valida sequência de valores (importante para database)
     */
    public function values_follow_expected_sequence(): void
    {
        $this->assertEquals(0, PaymentStatusEnum::UNPAID->value);
        $this->assertEquals(1, PaymentStatusEnum::PAID->value);
        $this->assertEquals(2, PaymentStatusEnum::OVERDUE->value);
        $this->assertEquals(3, PaymentStatusEnum::CANCELLED->value);
        $this->assertEquals(4, PaymentStatusEnum::PARTIAL->value);
    }

    /**
     * @test
     * Performance: Valida que getLabel() é rápido
     */
    public function get_label_is_performant(): void
    {
        $start = microtime(true);
        $iterations = 10000;

        for ($i = 0; $i < $iterations; $i++) {
            foreach (PaymentStatusEnum::cases() as $case) {
                $case->getLabel();
            }
        }

        $duration = microtime(true) - $start;

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
            foreach (PaymentStatusEnum::cases() as $case) {
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
            foreach (PaymentStatusEnum::cases() as $case) {
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
     * Segurança: Valida que labels são seguros (sem HTML/JS)
     */
    public function labels_are_safe_from_xss(): void
    {
        foreach (PaymentStatusEnum::cases() as $case) {
            $label = $case->getLabel();

            $this->assertDoesNotMatchRegularExpression(
                '/<script|<iframe|javascript:|onerror=/i',
                $label,
                "Label do case {$case->name} não deve conter código malicioso"
            );

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

        foreach (PaymentStatusEnum::cases() as $case) {
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
     * Segurança: Valida que ícones são válidos heroicons
     */
    public function icons_are_valid_heroicons(): void
    {
        foreach (PaymentStatusEnum::cases() as $case) {
            $icon = $case->getIcon();

            $this->assertStringStartsWith(
                'heroicon-',
                $icon,
                "Ícone '{$icon}' do case {$case->name} deve ser um Heroicon válido"
            );

            $this->assertDoesNotMatchRegularExpression(
                '/[<>"\']/',
                $icon,
                "Ícone do case {$case->name} não deve conter caracteres perigosos"
            );
        }
    }

    /**
     * @test
     * Valida que todos os casos têm implementação completa
     */
    public function all_cases_have_complete_implementation(): void
    {
        foreach (PaymentStatusEnum::cases() as $case) {
            $this->assertNotEmpty($case->getLabel(), "Case {$case->name} deve ter label");
            $this->assertNotEmpty($case->getColor(), "Case {$case->name} deve ter cor");
            $this->assertNotEmpty($case->getIcon(), "Case {$case->name} deve ter ícone");
        }
    }

    /**
     * @test
     * Segurança: Testa criação de enum a partir de valor inteiro
     */
    public function it_can_be_created_from_valid_integer(): void
    {
        $this->assertEquals(PaymentStatusEnum::UNPAID, PaymentStatusEnum::from(0));
        $this->assertEquals(PaymentStatusEnum::PAID, PaymentStatusEnum::from(1));
        $this->assertEquals(PaymentStatusEnum::OVERDUE, PaymentStatusEnum::from(2));
        $this->assertEquals(PaymentStatusEnum::CANCELLED, PaymentStatusEnum::from(3));
        $this->assertEquals(PaymentStatusEnum::PARTIAL, PaymentStatusEnum::from(4));
    }

    /**
     * @test
     * Segurança: Valida que valores inválidos lançam exceção
     */
    public function it_throws_exception_for_invalid_integer(): void
    {
        $this->expectException(ValueError::class);
        PaymentStatusEnum::from(999);
    }

    /**
     * @test
     * Segurança: Valida que valores negativos lançam exceção
     */
    public function it_throws_exception_for_negative_values(): void
    {
        $this->expectException(ValueError::class);
        PaymentStatusEnum::from(-1);
    }

    /**
     * @test
     * Segurança: tryFrom retorna null para valores inválidos
     */
    public function try_from_returns_null_for_invalid_values(): void
    {
        $this->assertNull(PaymentStatusEnum::tryFrom(999));
        $this->assertNull(PaymentStatusEnum::tryFrom(-1));
        $this->assertNull(PaymentStatusEnum::tryFrom(100));
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
            PaymentStatusEnum::tryFrom($i % 5); // Cicla entre 0-4
        }

        $duration = microtime(true) - $start;

        $this->assertLessThan(
            0.05,
            $duration,
            "Criação de enum deve ser performante (levou {$duration}s para {$iterations} iterações)"
        );
    }

    /**
     * @test
     * Valida número esperado de casos (evita remoção acidental)
     */
    public function it_has_expected_number_of_cases(): void
    {
        $this->assertCount(5, PaymentStatusEnum::cases(), 'Deve ter exatamente 5 status de pagamento');
    }

    /**
     * @test
     * Segurança: Valida que cores refletem criticidade do status
     */
    public function colors_reflect_status_criticality(): void
    {
        // Status críticos devem ter cores de alerta
        $this->assertEquals('danger', PaymentStatusEnum::OVERDUE->getColor());

        // Status positivos devem ter cor de sucesso
        $this->assertEquals('success', PaymentStatusEnum::PAID->getColor());

        // Status neutros devem ter cores adequadas
        $this->assertEquals('warning', PaymentStatusEnum::UNPAID->getColor());
        $this->assertEquals('gray', PaymentStatusEnum::CANCELLED->getColor());
        $this->assertEquals('info', PaymentStatusEnum::PARTIAL->getColor());
    }

    /**
     * @test
     * Segurança: Valida que valores são adequados para uso em banco de dados
     */
    public function values_are_database_safe(): void
    {
        foreach (PaymentStatusEnum::cases() as $case) {
            // Valores devem ser pequenos (< 256 para tinyint)
            $this->assertLessThan(256, $case->value);

            // Valores devem ser >= 0
            $this->assertGreaterThanOrEqual(0, $case->value);
        }
    }
}
