<?php

declare(strict_types=1);

namespace App\Services\AI;

use Exception;
use OpenAI\Laravel\Facades\OpenAI;

final class EmailTemplateAIGenerator
{
    private int $maxRetries = 3;

    private int $retryDelaySeconds = 2;

    public function generateEmailTemplate(
        string $templateType,
        string $context,
        string $tone = 'profissional',
        array $variables = [],
    ): array {
        $prompt = $this->buildPrompt($templateType, $context, $tone, $variables);

        $response = $this->makeOpenAIRequest(
            messages: [
                [
                    'role' => 'system',
                    'content' => 'Você é um especialista em criar templates de email profissionais e eficazes em português brasileiro. Você deve gerar emails bem estruturados, claros e que utilizem as variáveis fornecidas corretamente.',
                ],
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            maxTokens: 2000,
        );

        $content = $response->choices[0]->message->content;

        return $this->parseResponse($content);
    }

    public function getTemplateTypes(): array
    {
        return [
            'appointment_confirmation' => [
                'label' => 'Confirmação de Agendamento',
                'context' => 'Confirmar agendamento de serviço com data e hora',
                'variables' => ['customer.name', 'service_order.number', 'appointment.date', 'appointment.time', 'company.name'],
            ],
            'appointment_reminder' => [
                'label' => 'Lembrete de Agendamento',
                'context' => 'Lembrar cliente sobre agendamento próximo',
                'variables' => ['customer.name', 'service_order.number', 'appointment.date', 'appointment.time', 'company.name'],
            ],
            'budget_approval' => [
                'label' => 'Solicitação de Aprovação de Orçamento',
                'context' => 'Solicitar aprovação de orçamento ao cliente',
                'variables' => ['customer.name', 'service_order.number', 'budget.total', 'budget.valid_until', 'company.name'],
            ],
            'service_completed' => [
                'label' => 'Serviço Concluído',
                'context' => 'Notificar cliente sobre conclusão do serviço',
                'variables' => ['customer.name', 'service_order.number', 'total_value', 'company.name', 'company.phone'],
            ],
            'payment_reminder' => [
                'label' => 'Lembrete de Pagamento',
                'context' => 'Lembrar cliente sobre pagamento pendente',
                'variables' => ['customer.name', 'invoice.number', 'amount_due', 'due_date', 'company.name'],
            ],
            'payment_received' => [
                'label' => 'Confirmação de Pagamento Recebido',
                'context' => 'Confirmar recebimento de pagamento',
                'variables' => ['customer.name', 'payment.amount', 'payment.date', 'invoice.number', 'company.name'],
            ],
            'welcome' => [
                'label' => 'Boas-vindas',
                'context' => 'Email de boas-vindas para novo cliente',
                'variables' => ['customer.name', 'company.name', 'company.website', 'company.phone'],
            ],
            'feedback_request' => [
                'label' => 'Solicitação de Feedback',
                'context' => 'Pedir avaliação do serviço prestado',
                'variables' => ['customer.name', 'service_order.number', 'company.name', 'feedback.link'],
            ],
            'custom' => [
                'label' => 'Template Personalizado',
                'context' => 'Template genérico personalizado',
                'variables' => [],
            ],
        ];
    }

    private function makeOpenAIRequest(
        array $messages,
        int $maxTokens = 2000,
        float $temperature = 0.7,
    ): mixed {
        $originalTimeLimit = ini_get('max_execution_time');
        set_time_limit(120);

        $attempt = 0;

        try {
            while ($attempt < $this->maxRetries) {
                try {
                    return OpenAI::chat()->create([
                        'model' => 'gpt-4o-mini',
                        'messages' => $messages,
                        'temperature' => $temperature,
                        'max_completion_tokens' => $maxTokens,
                    ]);
                } catch (Exception $e) {
                    $attempt++;

                    if (str_contains($e->getMessage(), 'rate limit') || str_contains($e->getMessage(), 'Rate limit')) {
                        if ($attempt < $this->maxRetries) {
                            $delaySeconds = $this->retryDelaySeconds * $attempt;
                            sleep($delaySeconds);

                            continue;
                        }

                        throw new Exception(
                            'Limite de requisições da OpenAI excedido. Por favor, aguarde alguns minutos e tente novamente.'
                        );
                    }

                    throw $e;
                }
            }

            throw new Exception('Falha ao se comunicar com a API da OpenAI após múltiplas tentativas.');
        } finally {
            set_time_limit((int) $originalTimeLimit);
        }
    }

    private function buildPrompt(
        string $templateType,
        string $context,
        string $tone,
        array $variables,
    ): string {
        $variablesList = ! empty($variables) ? implode(', ', array_map(fn ($v) => "{{{$v}}}", $variables)) : 'nenhuma variável específica';

        return <<<PROMPT
Crie um template de email HTML profissional para o seguinte tipo:

TIPO DE EMAIL: {$templateType}
CONTEXTO: {$context}
TOM: {$tone}
VARIÁVEIS DISPONÍVEIS: {$variablesList}

O template deve:
1. Ser responsivo e bem formatado em HTML
2. Incluir um design limpo e profissional
3. Utilizar as variáveis fornecidas (no formato {{variavel}}) de forma apropriada
4. Ser direto e objetivo, respeitando o tom especificado
5. Incluir um call-to-action claro quando apropriado
6. Ser compatível com a maioria dos clientes de email

Estrutura do email:
- Saudação personalizada
- Corpo principal com informações relevantes
- Call-to-action (se aplicável)
- Assinatura/rodapé profissional

IMPORTANTE: Use apenas HTML inline CSS para garantir compatibilidade com clientes de email.

Forneça a resposta no seguinte formato:
ASSUNTO: [assunto do email]
CORPO: [HTML completo do email]
PROMPT;
    }

    private function parseResponse(string $content): array
    {
        $lines = explode("\n", $content);
        $data = [
            'subject' => '',
            'body' => '',
        ];

        $currentSection = null;
        $bodyLines = [];

        foreach ($lines as $line) {
            $line = mb_trim($line);

            if (str_starts_with($line, 'ASSUNTO:')) {
                $data['subject'] = mb_trim(mb_substr($line, 8));

                continue;
            }

            if (str_starts_with($line, 'CORPO:')) {
                $currentSection = 'body';
                $bodyLines = [];

                continue;
            }

            if ($currentSection === 'body' && $line !== '') {
                $bodyLines[] = $line;
            }
        }

        $data['body'] = $this->cleanHTMLContent(implode("\n", $bodyLines));

        return $data;
    }

    private function cleanHTMLContent(string $content): string
    {
        $content = mb_trim($content);

        // Remove marcadores de bloco de código markdown
        $content = preg_replace('/^```(?:html|xml|htm)?\s*/i', '', $content);
        $content = preg_replace('/\s*```\s*$/', '', $content);

        return mb_trim($content);
    }
}
