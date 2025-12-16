<?php

declare(strict_types=1);

namespace App\Services\Template;

use App\Enum\Template\TemplateContext;
use App\Models\ServiceOrder;

final class TemplateVariableRegistry
{
    /**
     * @return array<string, string>
     */
    public static function variablesFor(TemplateContext $context): array
    {
        return match ($context) {
            TemplateContext::ServiceOrder => [
                '{{service_order.number}}' => 'Número da OS',
                '{{service_order.status}}' => 'Status da OS',
                '{{service_order.priority}}' => 'Prioridade da OS',
                '{{service_order.opening_date}}' => 'Data de abertura (d/m/Y)',
                '{{service_order.expected_completion_date}}' => 'Previsão de conclusão (d/m/Y)',
                '{{service_order.completion_date}}' => 'Data de conclusão (d/m/Y)',
                '{{service_order.total_value}}' => 'Valor total',
                '{{service_order.labor_value}}' => 'Valor de mão de obra',
                '{{service_order.parts_value}}' => 'Valor de peças',
                '{{service_order.description}}' => 'Descrição',
                '{{service_order.observations}}' => 'Observações',
                '{{customer.name}}' => 'Nome do cliente',
                '{{customer.email}}' => 'E-mail do cliente (primeiro)',
            ],
        };
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function render(string $template, TemplateContext $context, array $data): string
    {
        $replacements = match ($context) {
            TemplateContext::ServiceOrder => self::renderServiceOrder($data),
        };

        return strtr($template, $replacements);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, string>
     */
    private static function renderServiceOrder(array $data): array
    {
        $replacements = [];

        /** @var ServiceOrder|null $order */
        $order = $data['serviceOrder'] ?? null;
        if ($order !== null) {
            $replacements = [
                '{{service_order.number}}' => (string) $order->getAttribute('number'),
                '{{service_order.status}}' => (string) $order->getAttribute('status'),
                '{{service_order.priority}}' => (string) $order->getAttribute('priority'),
                '{{service_order.opening_date}}' => optional($order->getAttribute('opening_date'))?->format('d/m/Y') ?? '',
                '{{service_order.expected_completion_date}}' => optional($order->getAttribute('expected_completion_date'))?->format('d/m/Y') ?? '',
                '{{service_order.completion_date}}' => optional($order->getAttribute('completion_date'))?->format('d/m/Y') ?? '',
                '{{service_order.total_value}}' => (string) $order->getAttribute('total_value'),
                '{{service_order.labor_value}}' => (string) $order->getAttribute('labor_value'),
                '{{service_order.parts_value}}' => (string) $order->getAttribute('parts_value'),
                '{{service_order.description}}' => (string) $order->getAttribute('description'),
                '{{service_order.observations}}' => (string) $order->getAttribute('observations'),
            ];

            $person = $order->relationLoaded('person') ? $order->getRelation('person') : $order->person()->first();
            if ($person !== null) {
                $replacements['{{customer.name}}'] = (string) $person->getAttribute('name');
                // pick first email if exists
                $email = method_exists($person, 'emails') ? $person->emails()->first() : null;
                $replacements['{{customer.email}}'] = $email?->getAttribute('email') ?? '';
            }
        }

        return $replacements;
    }
}
