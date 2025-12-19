<?php

declare(strict_types=1);

namespace Tests\Unit\Enum\DigitalSignature;

use App\Enum\DigitalSignature\SignatarioType;
use PHPUnit\Framework\TestCase;
use ValueError;

/**
 * Testes unitários para SignatarioType
 * Foco: Performance e Segurança
 */
final class SignatarioTypeTest extends TestCase
{
    /**
     * @test
     * Segurança: Valida que todos os valores são strings válidas
     */
    public function it_has_valid_string_values(): void
    {
        $cases = SignatarioType::cases();

        foreach ($cases as $case) {
            $this->assertIsString($case->value, "Case {$case->name} deve ter valor string");
            $this->assertNotEmpty($case->value, "Case {$case->name} não pode ter valor vazio");

            // Segurança: Não deve conter caracteres especiais perigosos
            $this->assertDoesNotMatchRegularExpression(
                '/[<>"\']/',
                $case->value,
                "Case {$case->name} não deve conter caracteres perigosos (XSS)"
            );

            // Deve seguir padrão snake_case ou lowercase
            $this->assertMatchesRegularExpression(
                '/^[a-z_]+$/',
                $case->value,
                "Case {$case->name} deve usar formato lowercase/snake_case"
            );
        }
    }

    /**
     * @test
     * Segurança: Valida que não há valores duplicados
     */
    public function it_has_unique_values(): void
    {
        $values = array_map(fn ($case) => $case->value, SignatarioType::cases());
        $uniqueValues = array_unique($values);

        $this->assertCount(
            count($values),
            $uniqueValues,
            'Não deve haver valores duplicados no enum'
        );
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
            foreach (SignatarioType::cases() as $case) {
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
     * Performance: Valida que getDescription() é rápido
     */
    public function get_description_is_performant(): void
    {
        $start = microtime(true);
        $iterations = 10000;

        for ($i = 0; $i < $iterations; $i++) {
            foreach (SignatarioType::cases() as $case) {
                $case->getDescription();
            }
        }

        $duration = microtime(true) - $start;

        $this->assertLessThan(
            0.1,
            $duration,
            "getDescription() deve ser performante (levou {$duration}s para {$iterations} iterações)"
        );
    }

    /**
     * @test
     * Performance: Valida que options() é rápido
     */
    public function options_method_is_performant(): void
    {
        $start = microtime(true);
        $iterations = 1000;

        for ($i = 0; $i < $iterations; $i++) {
            SignatarioType::options();
        }

        $duration = microtime(true) - $start;

        $this->assertLessThan(
            0.05,
            $duration,
            "options() deve ser performante (levou {$duration}s para {$iterations} iterações)"
        );
    }

    /**
     * @test
     * Segurança: Valida que labels são seguros (sem HTML/JS)
     */
    public function labels_are_safe_from_xss(): void
    {
        foreach (SignatarioType::cases() as $case) {
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
     * Segurança: Valida que descriptions são seguras (sem HTML/JS)
     */
    public function descriptions_are_safe_from_xss(): void
    {
        foreach (SignatarioType::cases() as $case) {
            $description = $case->getDescription();

            $this->assertDoesNotMatchRegularExpression(
                '/<script|<iframe|javascript:|onerror=/i',
                $description,
                "Description do case {$case->name} não deve conter código malicioso"
            );

            $this->assertEquals(
                strip_tags($description),
                $description,
                "Description do case {$case->name} não deve conter tags HTML"
            );
        }
    }

    /**
     * @test
     * Valida que todos os casos têm implementação completa
     */
    public function all_cases_have_complete_implementation(): void
    {
        foreach (SignatarioType::cases() as $case) {
            $this->assertNotEmpty($case->getLabel(), "Case {$case->name} deve ter label");
            $this->assertNotEmpty($case->getDescription(), "Case {$case->name} deve ter description");
        }
    }

    /**
     * @test
     * Valida que options() retorna array correto
     */
    public function options_returns_correct_array(): void
    {
        $options = SignatarioType::options();

        $this->assertIsArray($options);
        $this->assertNotEmpty($options);

        // Deve ter o mesmo número de itens que casos
        $this->assertCount(count(SignatarioType::cases()), $options);

        // Cada chave deve ser um valor válido do enum
        foreach (array_keys($options) as $key) {
            $this->assertNotNull(SignatarioType::tryFrom($key));
        }

        // Cada valor deve ser uma string não vazia
        foreach ($options as $value) {
            $this->assertIsString($value);
            $this->assertNotEmpty($value);
        }
    }

    /**
     * @test
     * Segurança: Testa criação de enum a partir de valor
     */
    public function it_can_be_created_from_valid_value(): void
    {
        $this->assertEquals(SignatarioType::Signer, SignatarioType::from('signer'));
        $this->assertEquals(SignatarioType::Witness, SignatarioType::from('witness'));
        $this->assertEquals(SignatarioType::Approver, SignatarioType::from('approver'));
    }

    /**
     * @test
     * Segurança: Valida que valores inválidos lançam exceção
     */
    public function it_throws_exception_for_invalid_value(): void
    {
        $this->expectException(ValueError::class);
        SignatarioType::from('invalid_type');
    }

    /**
     * @test
     * Segurança: tryFrom retorna null para valores inválidos sem lançar exceção
     */
    public function try_from_returns_null_for_invalid_value(): void
    {
        $this->assertNull(SignatarioType::tryFrom('invalid'));
        $this->assertNull(SignatarioType::tryFrom(''));
        $this->assertNull(SignatarioType::tryFrom('<script>alert("xss")</script>'));
        $this->assertNull(SignatarioType::tryFrom('1 OR 1=1')); // SQL injection attempt
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
            SignatarioType::tryFrom('signer');
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
     * Valida número esperado de casos
     */
    public function it_has_expected_number_of_cases(): void
    {
        $this->assertCount(3, SignatarioType::cases(), 'Deve ter exatamente 3 tipos de signatário');
    }

    /**
     * @test
     * Valida que valores são específicos e bem definidos
     */
    public function it_has_specific_case_values(): void
    {
        $expectedValues = ['signer', 'witness', 'approver'];
        $actualValues = array_map(fn ($case) => $case->value, SignatarioType::cases());

        sort($expectedValues);
        sort($actualValues);

        $this->assertEquals($expectedValues, $actualValues);
    }

    /**
     * @test
     * Segurança: Valida que options() não está vulnerável a mass assignment
     */
    public function options_array_keys_are_safe(): void
    {
        $options = SignatarioType::options();

        foreach (array_keys($options) as $key) {
            // Não deve conter SQL injection patterns
            $this->assertDoesNotMatchRegularExpression(
                '/union|select|insert|update|delete|drop|truncate/i',
                $key,
                'Key não deve conter padrões SQL perigosos'
            );

            // Não deve conter caracteres especiais perigosos
            $this->assertDoesNotMatchRegularExpression(
                '/[<>"\';]/',
                $key,
                'Key não deve conter caracteres perigosos'
            );
        }
    }

    /**
     * @test
     * Performance: Valida que múltiplas chamadas a options() não degradam performance
     */
    public function multiple_options_calls_are_fast(): void
    {
        $start = microtime(true);
        $iterations = 10000;

        for ($i = 0; $i < $iterations; $i++) {
            SignatarioType::options();
        }

        $duration = microtime(true) - $start;

        // Note: options() usa collect(), então pode ser um pouco mais lento
        $this->assertLessThan(
            0.5,
            $duration,
            "Múltiplas chamadas a options() devem ser razoavelmente rápidas (levou {$duration}s para {$iterations} iterações)"
        );
    }
}
