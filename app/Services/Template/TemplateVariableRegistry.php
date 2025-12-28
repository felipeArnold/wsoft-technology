<?php

declare(strict_types=1);

namespace App\Services\Template;

use App\Enum\Template\TemplateContext;
use App\Models\Accounts\Accounts;
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
                '{{company.name}}' => 'Nome da empresa',
                '{{company.email}}' => 'E-mail da empresa',
                '{{company.phone}}' => 'Telefone da empresa',
            ],
            TemplateContext::AccountsPayable => [
                '{{account.reference_number}}' => 'Número de referência',
                '{{account.amount}}' => 'Valor total (R$)',
                '{{account.parcels}}' => 'Número de parcelas',
                '{{account.installment_number}}' => 'Número da parcela atual',
                '{{account.status}}' => 'Status (pending/paid/overdue)',
                '{{account.payment_method}}' => 'Forma de pagamento',
                '{{account.due_date}}' => 'Data de vencimento (d/m/Y)',
                '{{account.paid_at}}' => 'Data de pagamento (d/m/Y H:i)',
                '{{account.discount_amount}}' => 'Valor de desconto (R$)',
                '{{account.interest_amount}}' => 'Valor de juros (R$)',
                '{{account.fine_amount}}' => 'Valor de multa (R$)',
                '{{account.notes}}' => 'Observações',
                '{{account.payment_instructions}}' => 'Instruções de pagamento',
                '{{account.category}}' => 'Categoria',
                '{{supplier.name}}' => 'Nome do fornecedor',
                '{{supplier.email}}' => 'E-mail do fornecedor (primeiro)',
                '{{company.name}}' => 'Nome da empresa',
                '{{company.email}}' => 'E-mail da empresa',
            ],
            TemplateContext::AccountsReceivable => [
                '{{account.reference_number}}' => 'Número de referência',
                '{{account.amount}}' => 'Valor total (R$)',
                '{{account.parcels}}' => 'Número de parcelas',
                '{{account.installment_number}}' => 'Número da parcela atual',
                '{{account.status}}' => 'Status (pending/paid/overdue)',
                '{{account.payment_method}}' => 'Forma de pagamento',
                '{{account.due_date}}' => 'Data de vencimento (d/m/Y)',
                '{{account.paid_at}}' => 'Data de pagamento (d/m/Y H:i)',
                '{{account.discount_amount}}' => 'Valor de desconto (R$)',
                '{{account.interest_amount}}' => 'Valor de juros (R$)',
                '{{account.fine_amount}}' => 'Valor de multa (R$)',
                '{{account.notes}}' => 'Observações',
                '{{account.payment_instructions}}' => 'Instruções de pagamento',
                '{{account.category}}' => 'Categoria',
                '{{customer.name}}' => 'Nome do cliente',
                '{{customer.email}}' => 'E-mail do cliente (primeiro)',
                '{{company.name}}' => 'Nome da empresa',
                '{{company.email}}' => 'E-mail da empresa',
            ],
            TemplateContext::Overdue => [
                '{{account.reference_number}}' => 'Número de referência',
                '{{account.amount}}' => 'Valor total (R$)',
                '{{account.parcels}}' => 'Número de parcelas',
                '{{account.installment_number}}' => 'Número da parcela atual',
                '{{account.status}}' => 'Status (pending/paid/overdue)',
                '{{account.payment_method}}' => 'Forma de pagamento',
                '{{account.due_date}}' => 'Data de vencimento (d/m/Y)',
                '{{account.days_overdue}}' => 'Dias em atraso',
                '{{account.discount_amount}}' => 'Valor de desconto (R$)',
                '{{account.interest_amount}}' => 'Valor de juros (R$)',
                '{{account.fine_amount}}' => 'Valor de multa (R$)',
                '{{account.total_with_fees}}' => 'Valor total com juros e multa (R$)',
                '{{account.notes}}' => 'Observações',
                '{{account.payment_instructions}}' => 'Instruções de pagamento',
                '{{account.category}}' => 'Categoria',
                '{{customer.name}}' => 'Nome do cliente',
                '{{customer.email}}' => 'E-mail do cliente (primeiro)',
                '{{company.name}}' => 'Nome da empresa',
                '{{company.email}}' => 'E-mail da empresa',
                '{{company.phone}}' => 'Telefone da empresa',
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
            TemplateContext::AccountsPayable => self::renderAccountsPayable($data),
            TemplateContext::AccountsReceivable => self::renderAccountsReceivable($data),
            TemplateContext::Overdue => self::renderOverdue($data),
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
                '{{service_order.total_value}}' => 'R$ '.number_format((float) $order->getAttribute('total_value'), 2, ',', '.'),
                '{{service_order.labor_value}}' => 'R$ '.number_format((float) $order->getAttribute('labor_value'), 2, ',', '.'),
                '{{service_order.parts_value}}' => 'R$ '.number_format((float) $order->getAttribute('parts_value'), 2, ',', '.'),
                '{{service_order.description}}' => (string) $order->getAttribute('description'),
                '{{service_order.observations}}' => (string) $order->getAttribute('observations'),
            ];

            $person = $order->relationLoaded('person') ? $order->getRelation('person') : $order->person()->first();
            if ($person !== null) {
                $replacements['{{customer.name}}'] = (string) $person->getAttribute('name');
                // pick first email if exists
                $email = method_exists($person, 'emails') ? $person->emails()->first() : null;
                $replacements['{{customer.email}}'] = $email?->getAttribute('address') ?? '';
            }

            // Company/Tenant information
            $tenant = $order->relationLoaded('tenant') ? $order->getRelation('tenant') : $order->tenant()->first();
            if ($tenant !== null) {
                $replacements['{{company.name}}'] = (string) $tenant->getAttribute('name');
                $replacements['{{company.email}}'] = (string) ($tenant->getAttribute('email') ?? '');
                $replacements['{{company.phone}}'] = (string) ($tenant->getAttribute('phone') ?? '');
            }
        }

        return $replacements;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, string>
     */
    private static function renderAccountsPayable(array $data): array
    {
        $replacements = [];

        /** @var Accounts|null $account */
        $account = $data['account'] ?? null;
        if ($account !== null) {
            $replacements = [
                '{{account.reference_number}}' => (string) ($account->getAttribute('reference_number') ?? ''),
                '{{account.amount}}' => 'R$ '.number_format((float) $account->getAttribute('amount'), 2, ',', '.'),
                '{{account.parcels}}' => (string) ($account->getAttribute('parcels') ?? '1'),
                '{{account.installment_number}}' => (string) ($account->getAttribute('installment_number') ?? '1'),
                '{{account.status}}' => (string) $account->getAttribute('status'),
                '{{account.payment_method}}' => $account->getAttribute('payment_method')?->getLabel() ?? '',
                '{{account.due_date}}' => optional($account->getAttribute('due_date'))?->format('d/m/Y') ?? '',
                '{{account.paid_at}}' => optional($account->getAttribute('paid_at'))?->format('d/m/Y H:i') ?? '',
                '{{account.discount_amount}}' => 'R$ '.number_format((float) $account->getAttribute('discount_amount'), 2, ',', '.'),
                '{{account.interest_amount}}' => 'R$ '.number_format((float) $account->getAttribute('interest_amount'), 2, ',', '.'),
                '{{account.fine_amount}}' => 'R$ '.number_format((float) $account->getAttribute('fine_amount'), 2, ',', '.'),
                '{{account.notes}}' => (string) ($account->getAttribute('notes') ?? ''),
                '{{account.payment_instructions}}' => (string) ($account->getAttribute('payment_instructions') ?? ''),
                '{{account.category}}' => (string) ($account->getAttribute('category') ?? ''),
            ];

            // Supplier/Person information (for payables)
            $person = $account->relationLoaded('person') ? $account->getRelation('person') : $account->person()->first();
            if ($person !== null) {
                $replacements['{{supplier.name}}'] = (string) $person->getAttribute('name');
                // pick first email if exists
                $email = method_exists($person, 'emails') ? $person->emails()->first() : null;
                $replacements['{{supplier.email}}'] = $email?->getAttribute('email') ?? '';
            }

            // Company/Tenant information
            $tenant = $account->relationLoaded('tenant') ? $account->getRelation('tenant') : $account->tenant()->first();
            if ($tenant !== null) {
                $replacements['{{company.name}}'] = (string) $tenant->getAttribute('name');
                $replacements['{{company.email}}'] = (string) ($tenant->getAttribute('email') ?? '');
            }
        }

        return $replacements;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, string>
     */
    private static function renderAccountsReceivable(array $data): array
    {
        $replacements = [];

        /** @var Accounts|null $account */
        $account = $data['account'] ?? null;
        if ($account !== null) {
            $replacements = [
                '{{account.reference_number}}' => (string) ($account->getAttribute('reference_number') ?? ''),
                '{{account.amount}}' => 'R$ '.number_format((float) $account->getAttribute('amount'), 2, ',', '.'),
                '{{account.parcels}}' => (string) ($account->getAttribute('parcels') ?? '1'),
                '{{account.installment_number}}' => (string) ($account->getAttribute('installment_number') ?? '1'),
                '{{account.status}}' => (string) $account->getAttribute('status'),
                '{{account.payment_method}}' => $account->getAttribute('payment_method')?->getLabel() ?? '',
                '{{account.due_date}}' => optional($account->getAttribute('due_date'))?->format('d/m/Y') ?? '',
                '{{account.paid_at}}' => optional($account->getAttribute('paid_at'))?->format('d/m/Y H:i') ?? '',
                '{{account.discount_amount}}' => 'R$ '.number_format((float) $account->getAttribute('discount_amount'), 2, ',', '.'),
                '{{account.interest_amount}}' => 'R$ '.number_format((float) $account->getAttribute('interest_amount'), 2, ',', '.'),
                '{{account.fine_amount}}' => 'R$ '.number_format((float) $account->getAttribute('fine_amount'), 2, ',', '.'),
                '{{account.notes}}' => (string) ($account->getAttribute('notes') ?? ''),
                '{{account.payment_instructions}}' => (string) ($account->getAttribute('payment_instructions') ?? ''),
                '{{account.category}}' => (string) ($account->getAttribute('category') ?? ''),
            ];

            // Customer/Person information (for receivables)
            $person = $account->relationLoaded('person') ? $account->getRelation('person') : $account->person()->first();
            if ($person !== null) {
                $replacements['{{customer.name}}'] = (string) $person->getAttribute('name');
                // pick first email if exists
                $email = method_exists($person, 'emails') ? $person->emails()->first() : null;
                $replacements['{{customer.email}}'] = $email?->getAttribute('email') ?? '';
            }

            // Company/Tenant information
            $tenant = $account->relationLoaded('tenant') ? $account->getRelation('tenant') : $account->tenant()->first();
            if ($tenant !== null) {
                $replacements['{{company.name}}'] = (string) $tenant->getAttribute('name');
                $replacements['{{company.email}}'] = (string) ($tenant->getAttribute('email') ?? '');
            }
        }

        return $replacements;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, string>
     */
    private static function renderOverdue(array $data): array
    {
        $replacements = [];

        /** @var Accounts|null $account */
        $account = $data['account'] ?? null;
        if ($account !== null) {
            // Calculate days overdue
            $dueDate = $account->getAttribute('due_date');
            $daysOverdue = $dueDate ? now()->diffInDays($dueDate, false) : 0;
            $daysOverdue = max(0, (int) $daysOverdue); // Only positive values

            // Calculate total with fees
            $amount = (float) $account->getAttribute('amount');
            $interestAmount = (float) $account->getAttribute('interest_amount');
            $fineAmount = (float) $account->getAttribute('fine_amount');
            $totalWithFees = $amount + $interestAmount + $fineAmount;

            $replacements = [
                '{{account.reference_number}}' => (string) ($account->getAttribute('reference_number') ?? ''),
                '{{account.amount}}' => 'R$ '.number_format($amount, 2, ',', '.'),
                '{{account.parcels}}' => (string) ($account->getAttribute('parcels') ?? '1'),
                '{{account.installment_number}}' => (string) ($account->getAttribute('installment_number') ?? '1'),
                '{{account.status}}' => (string) $account->getAttribute('status'),
                '{{account.payment_method}}' => $account->getAttribute('payment_method')?->getLabel() ?? '',
                '{{account.due_date}}' => optional($account->getAttribute('due_date'))?->format('d/m/Y') ?? '',
                '{{account.days_overdue}}' => (string) $daysOverdue,
                '{{account.discount_amount}}' => 'R$ '.number_format((float) $account->getAttribute('discount_amount'), 2, ',', '.'),
                '{{account.interest_amount}}' => 'R$ '.number_format($interestAmount, 2, ',', '.'),
                '{{account.fine_amount}}' => 'R$ '.number_format($fineAmount, 2, ',', '.'),
                '{{account.total_with_fees}}' => 'R$ '.number_format($totalWithFees, 2, ',', '.'),
                '{{account.notes}}' => (string) ($account->getAttribute('notes') ?? ''),
                '{{account.payment_instructions}}' => (string) ($account->getAttribute('payment_instructions') ?? ''),
                '{{account.category}}' => (string) ($account->getAttribute('category') ?? ''),
            ];

            // Customer/Person information
            $person = $account->relationLoaded('person') ? $account->getRelation('person') : $account->person()->first();
            if ($person !== null) {
                $replacements['{{customer.name}}'] = (string) $person->getAttribute('name');
                // pick first email if exists
                $email = method_exists($person, 'emails') ? $person->emails()->first() : null;
                $replacements['{{customer.email}}'] = $email?->getAttribute('email') ?? '';
            }

            // Company/Tenant information
            $tenant = $account->relationLoaded('tenant') ? $account->getRelation('tenant') : $account->tenant()->first();
            if ($tenant !== null) {
                $replacements['{{company.name}}'] = (string) $tenant->getAttribute('name');
                $replacements['{{company.email}}'] = (string) ($tenant->getAttribute('email') ?? '');
                $replacements['{{company.phone}}'] = (string) ($tenant->getAttribute('phone') ?? '');
            }
        }

        return $replacements;
    }
}
