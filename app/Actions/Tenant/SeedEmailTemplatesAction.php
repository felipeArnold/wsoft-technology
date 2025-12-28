<?php

declare(strict_types=1);

namespace App\Actions\Tenant;

use App\Models\EmailTemplate;
use App\Models\Tenant;

final class SeedEmailTemplatesAction
{
    /**
     * Executa o seeding de email templates para um tenant específico.
     */
    public function execute(Tenant $tenant): void
    {
        $templates = $this->getDefaultTemplates();

        foreach ($templates as $template) {
            EmailTemplate::updateOrCreate(
                [
                    'tenant_id' => $tenant->id,
                    'context' => $template['context'],
                    'name' => $template['name'],
                ],
                [
                    'subject' => $template['subject'],
                    'body' => $template['body'],
                    'is_active' => $template['is_active'],
                ]
            );
        }
    }

    /**
     * Retorna a lista de templates padrão.
     */
    private function getDefaultTemplates(): array
    {
        return [
            // ==================== ORDEM DE SERVIÇO ====================
            [
                'name' => 'Confirmação de Agendamento',
                'context' => 'ServiceOrder',
                'subject' => 'Confirmação de Agendamento - OS {{service_order.number}}',
                'body' => '<h2>Agendamento Confirmado</h2>

<p>Olá {{customer.name}},</p>

<p>Confirmamos o agendamento do seu serviço:</p>

<ul>
    <li><strong>Número da OS:</strong> {{service_order.number}}</li>
    <li><strong>Data de Abertura:</strong> {{service_order.opening_date}}</li>
    <li><strong>Previsão de Conclusão:</strong> {{service_order.expected_completion_date}}</li>
    <li><strong>Prioridade:</strong> {{service_order.priority}}</li>
    <li><strong>Status:</strong> {{service_order.status}}</li>
</ul>

<p><strong>Descrição do Serviço:</strong><br>
{{service_order.description}}</p>

<p><strong>Observações:</strong><br>
{{service_order.observations}}</p>

<p>Caso precise remarcar ou tenha alguma dúvida, entre em contato conosco.</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],
            [
                'name' => 'Lembrete de Agendamento',
                'context' => 'ServiceOrder',
                'subject' => 'Lembrete de Agendamento - OS {{service_order.number}}',
                'body' => '<h2>Lembrete de Agendamento</h2>

<p>Olá {{customer.name}},</p>

<p>Este é um lembrete sobre o agendamento do seu serviço:</p>

<ul>
    <li><strong>Número da OS:</strong> {{service_order.number}}</li>
    <li><strong>Data Prevista:</strong> {{service_order.expected_completion_date}}</li>
    <li><strong>Prioridade:</strong> {{service_order.priority}}</li>
</ul>

<p><strong>Descrição do Serviço:</strong><br>
{{service_order.description}}</p>

<p>Aguardamos você!</p>

<p>Caso precise remarcar, entre em contato o quanto antes.</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],
            [
                'name' => 'Aprovação de Orçamento',
                'context' => 'ServiceOrder',
                'subject' => 'Solicitação de Aprovação de Orçamento - OS {{service_order.number}}',
                'body' => '<h2>Aprovação de Orçamento Necessária</h2>

<p>Olá {{customer.name}},</p>

<p>Preparamos o orçamento para o seu serviço:</p>

<ul>
    <li><strong>Número da OS:</strong> {{service_order.number}}</li>
    <li><strong>Valor de Mão de Obra:</strong> {{service_order.labor_value}}</li>
    <li><strong>Valor de Peças:</strong> {{service_order.parts_value}}</li>
    <li><strong>Valor Total:</strong> {{service_order.total_value}}</li>
</ul>

<p><strong>Descrição do Serviço:</strong><br>
{{service_order.description}}</p>

<p><strong>Observações:</strong><br>
{{service_order.observations}}</p>

<p>Por favor, entre em contato para aprovar ou discutir o orçamento.</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],
            [
                'name' => 'Serviço em Andamento',
                'context' => 'ServiceOrder',
                'subject' => 'Atualização: Serviço em Andamento - OS {{service_order.number}}',
                'body' => '<h2>Seu Serviço Está em Andamento</h2>

<p>Olá {{customer.name}},</p>

<p>Informamos que o seu serviço já está sendo executado:</p>

<ul>
    <li><strong>Número da OS:</strong> {{service_order.number}}</li>
    <li><strong>Status:</strong> {{service_order.status}}</li>
    <li><strong>Previsão de Conclusão:</strong> {{service_order.expected_completion_date}}</li>
    <li><strong>Prioridade:</strong> {{service_order.priority}}</li>
</ul>

<p><strong>Descrição do Serviço:</strong><br>
{{service_order.description}}</p>

<p>Manteremos você informado sobre o progresso do serviço.</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],
            [
                'name' => 'Serviço Concluído',
                'context' => 'ServiceOrder',
                'subject' => 'Serviço Concluído - OS {{service_order.number}}',
                'body' => '<h2>Serviço Concluído com Sucesso!</h2>

<p>Olá {{customer.name}},</p>

<p>Temos o prazer de informar que seu serviço foi concluído:</p>

<ul>
    <li><strong>Número da OS:</strong> {{service_order.number}}</li>
    <li><strong>Data de Abertura:</strong> {{service_order.opening_date}}</li>
    <li><strong>Data de Conclusão:</strong> {{service_order.completion_date}}</li>
    <li><strong>Valor Total:</strong> {{service_order.total_value}}</li>
</ul>

<p><strong>Detalhamento dos Valores:</strong></p>
<ul>
    <li>Mão de Obra: {{service_order.labor_value}}</li>
    <li>Peças: {{service_order.parts_value}}</li>
    <li><strong>Total: {{service_order.total_value}}</strong></li>
</ul>

<p><strong>Descrição do Serviço:</strong><br>
{{service_order.description}}</p>

<p><strong>Observações:</strong><br>
{{service_order.observations}}</p>

<p>Você já pode retirar seu veículo/equipamento. Caso haja alguma pendência, entraremos em contato.</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],
            [
                'name' => 'Solicitação de Feedback',
                'context' => 'ServiceOrder',
                'subject' => 'Como foi sua experiência? - OS {{service_order.number}}',
                'body' => '<h2>Sua Opinião é Importante!</h2>

<p>Olá {{customer.name}},</p>

<p>Agradecemos por escolher nossos serviços!</p>

<p>Concluímos recentemente o serviço da OS {{service_order.number}}. Gostaríamos muito de saber sobre sua experiência:</p>

<ul>
    <li>O serviço atendeu suas expectativas?</li>
    <li>O atendimento foi satisfatório?</li>
    <li>Você nos recomendaria para outras pessoas?</li>
</ul>

<p>Seu feedback nos ajuda a melhorar continuamente nossos serviços.</p>

<p>Por favor, responda este e-mail ou entre em contato conosco através do e-mail {{customer.email}} ou telefone.</p>

<p>Muito obrigado!</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],

            // ==================== CONTAS A PAGAR ====================
            [
                'name' => 'Nova Conta a Pagar',
                'context' => 'AccountsPayable',
                'subject' => 'Nova Conta a Pagar - {{account.reference_number}}',
                'body' => '<h2>Nova Conta a Pagar Registrada</h2>

<p>Olá,</p>

<p>Uma nova conta a pagar foi registrada no sistema:</p>

<ul>
    <li><strong>Número de Referência:</strong> {{account.reference_number}}</li>
    <li><strong>Fornecedor:</strong> {{supplier.name}}</li>
    <li><strong>Valor:</strong> {{account.amount}}</li>
    <li><strong>Parcelas:</strong> {{account.parcels}}x</li>
    <li><strong>Forma de Pagamento:</strong> {{account.payment_method}}</li>
    <li><strong>Data de Vencimento:</strong> {{account.due_date}}</li>
    <li><strong>Categoria:</strong> {{account.category}}</li>
</ul>

<p><strong>Instruções de Pagamento:</strong><br>
{{account.payment_instructions}}</p>

<p><strong>Observações:</strong><br>
{{account.notes}}</p>

<p>Por favor, organize-se para efetuar o pagamento dentro do prazo.</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],
            [
                'name' => 'Vencimento Próximo',
                'context' => 'AccountsPayable',
                'subject' => 'Lembrete: Vencimento Próximo - {{account.reference_number}}',
                'body' => '<h2>Lembrete de Vencimento Próximo</h2>

<p>Olá,</p>

<p>Este é um lembrete de que a seguinte conta a pagar está próxima do vencimento:</p>

<ul>
    <li><strong>Número de Referência:</strong> {{account.reference_number}}</li>
    <li><strong>Fornecedor:</strong> {{supplier.name}}</li>
    <li><strong>Valor:</strong> {{account.amount}}</li>
    <li><strong>Parcela:</strong> {{account.installment_number}} de {{account.parcels}}</li>
    <li><strong>Data de Vencimento:</strong> {{account.due_date}}</li>
    <li><strong>Forma de Pagamento:</strong> {{account.payment_method}}</li>
</ul>

<p><strong>Instruções de Pagamento:</strong><br>
{{account.payment_instructions}}</p>

<p>Por favor, certifique-se de que o pagamento será efetuado antes da data de vencimento para evitar juros e multas.</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],
            [
                'name' => 'Pagamento Efetuado',
                'context' => 'AccountsPayable',
                'subject' => 'Confirmação de Pagamento - {{account.reference_number}}',
                'body' => '<h2>Pagamento Confirmado</h2>

<p>Olá,</p>

<p>Confirmamos o pagamento da seguinte conta:</p>

<ul>
    <li><strong>Número de Referência:</strong> {{account.reference_number}}</li>
    <li><strong>Fornecedor:</strong> {{supplier.name}}</li>
    <li><strong>Valor Pago:</strong> {{account.amount}}</li>
    <li><strong>Parcela:</strong> {{account.installment_number}} de {{account.parcels}}</li>
    <li><strong>Data de Vencimento:</strong> {{account.due_date}}</li>
    <li><strong>Data de Pagamento:</strong> {{account.paid_at}}</li>
    <li><strong>Forma de Pagamento:</strong> {{account.payment_method}}</li>
</ul>

<p><strong>Valores:</strong></p>
<ul>
    <li>Valor da Conta: {{account.amount}}</li>
    <li>Desconto: {{account.discount_amount}}</li>
    <li>Juros: {{account.interest_amount}}</li>
    <li>Multa: {{account.fine_amount}}</li>
</ul>

<p>O pagamento foi processado com sucesso.</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],

            // ==================== CONTAS A RECEBER ====================
            [
                'name' => 'Nova Cobrança',
                'context' => 'AccountsReceivable',
                'subject' => 'Nova Cobrança - {{account.reference_number}}',
                'body' => '<h2>Nova Cobrança Gerada</h2>

<p>Olá {{customer.name}},</p>

<p>Uma nova cobrança foi gerada para você:</p>

<ul>
    <li><strong>Número de Referência:</strong> {{account.reference_number}}</li>
    <li><strong>Valor:</strong> {{account.amount}}</li>
    <li><strong>Parcelas:</strong> {{account.parcels}}x</li>
    <li><strong>Forma de Pagamento:</strong> {{account.payment_method}}</li>
    <li><strong>Data de Vencimento:</strong> {{account.due_date}}</li>
    <li><strong>Categoria:</strong> {{account.category}}</li>
</ul>

<p><strong>Instruções de Pagamento:</strong><br>
{{account.payment_instructions}}</p>

<p><strong>Observações:</strong><br>
{{account.notes}}</p>

<p>Por favor, efetue o pagamento até a data de vencimento para evitar juros e multas.</p>

<p>Em caso de dúvidas, entre em contato conosco pelo e-mail {{company.email}}.</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],
            [
                'name' => 'Vencimento Próximo',
                'context' => 'AccountsReceivable',
                'subject' => 'Lembrete de Vencimento - {{account.reference_number}}',
                'body' => '<h2>Lembrete de Vencimento</h2>

<p>Olá {{customer.name}},</p>

<p>Este é um lembrete de que sua cobrança está próxima do vencimento:</p>

<ul>
    <li><strong>Número de Referência:</strong> {{account.reference_number}}</li>
    <li><strong>Valor:</strong> {{account.amount}}</li>
    <li><strong>Parcela:</strong> {{account.installment_number}} de {{account.parcels}}</li>
    <li><strong>Data de Vencimento:</strong> {{account.due_date}}</li>
    <li><strong>Forma de Pagamento:</strong> {{account.payment_method}}</li>
</ul>

<p><strong>Instruções de Pagamento:</strong><br>
{{account.payment_instructions}}</p>

<p>Para evitar juros e multas, por favor efetue o pagamento até a data de vencimento.</p>

<p>Caso já tenha efetuado o pagamento, desconsidere este e-mail.</p>

<p>Em caso de dúvidas, entre em contato conosco pelo e-mail {{company.email}}.</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],
            [
                'name' => 'Recebimento Confirmado',
                'context' => 'AccountsReceivable',
                'subject' => 'Pagamento Recebido - {{account.reference_number}}',
                'body' => '<h2>Pagamento Confirmado</h2>

<p>Olá {{customer.name}},</p>

<p>Confirmamos o recebimento do seu pagamento:</p>

<ul>
    <li><strong>Número de Referência:</strong> {{account.reference_number}}</li>
    <li><strong>Valor Pago:</strong> {{account.amount}}</li>
    <li><strong>Parcela:</strong> {{account.installment_number}} de {{account.parcels}}</li>
    <li><strong>Data de Vencimento:</strong> {{account.due_date}}</li>
    <li><strong>Data de Pagamento:</strong> {{account.paid_at}}</li>
    <li><strong>Forma de Pagamento:</strong> {{account.payment_method}}</li>
</ul>

<p><strong>Detalhamento dos Valores:</strong></p>
<ul>
    <li>Valor da Conta: {{account.amount}}</li>
    <li>Desconto Aplicado: {{account.discount_amount}}</li>
    <li>Juros: {{account.interest_amount}}</li>
    <li>Multa: {{account.fine_amount}}</li>
</ul>

<p>Agradecemos pela pontualidade!</p>

<p>Em caso de dúvidas, entre em contato conosco pelo e-mail {{company.email}}.</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],

            // ==================== INADIMPLÊNCIA ====================
            [
                'name' => 'viso Inicial',
                'context' => 'Overdue',
                'subject' => 'Aviso de Vencimento - {{account.reference_number}}',
                'body' => '<h2>Aviso de Vencimento</h2>

<p>Olá {{customer.name}},</p>

<p>Identificamos que a seguinte cobrança venceu e ainda não foi paga:</p>

<ul>
    <li><strong>Número de Referência:</strong> {{account.reference_number}}</li>
    <li><strong>Valor Original:</strong> {{account.amount}}</li>
    <li><strong>Parcela:</strong> {{account.installment_number}} de {{account.parcels}}</li>
    <li><strong>Data de Vencimento:</strong> {{account.due_date}}</li>
    <li><strong>Dias em Atraso:</strong> {{account.days_overdue}}</li>
</ul>

<p><strong>Valores Atualizados:</strong></p>
<ul>
    <li>Valor Original: {{account.amount}}</li>
    <li>Juros: {{account.interest_amount}}</li>
    <li>Multa: {{account.fine_amount}}</li>
    <li><strong>Total a Pagar: {{account.total_with_fees}}</strong></li>
</ul>

<p><strong>Instruções de Pagamento:</strong><br>
{{account.payment_instructions}}</p>

<p>Por favor, regularize sua situação o quanto antes para evitar o acúmulo de juros e multas adicionais.</p>

<p>Caso já tenha efetuado o pagamento, desconsidere este e-mail e entre em contato para confirmarmos.</p>

<p>Em caso de dúvidas ou dificuldades, entre em contato conosco:</p>
<ul>
    <li>E-mail: {{company.email}}</li>
    <li>Telefone: {{company.phone}}</li>
</ul>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],
            [
                'name' => 'Lembrete de Cobrança em Atraso',
                'context' => 'Overdue',
                'subject' => 'Lembrete de Cobrança em Atraso - {{account.reference_number}}',
                'body' => '<h2>Lembrete de Cobrança em Atraso</h2>

<p>Olá {{customer.name}},</p>

<p>Este é um lembrete sobre a cobrança em atraso:</p>

<ul>
    <li><strong>Número de Referência:</strong> {{account.reference_number}}</li>
    <li><strong>Valor Original:</strong> {{account.amount}}</li>
    <li><strong>Parcela:</strong> {{account.installment_number}} de {{account.parcels}}</li>
    <li><strong>Data de Vencimento:</strong> {{account.due_date}}</li>
    <li><strong>Dias em Atraso:</strong> {{account.days_overdue}}</li>
</ul>

<p><strong>Valores Atualizados:</strong></p>
<ul>
    <li>Valor Original: {{account.amount}}</li>
    <li>Desconto: {{account.discount_amount}}</li>
    <li>Juros Acumulados: {{account.interest_amount}}</li>
    <li>Multa: {{account.fine_amount}}</li>
    <li><strong>Total a Pagar: {{account.total_with_fees}}</strong></li>
</ul>

<p><strong>Instruções de Pagamento:</strong><br>
{{account.payment_instructions}}</p>

<p>Sua colaboração é muito importante para nós. Por favor, regularize sua situação o quanto antes.</p>

<p>Caso já tenha efetuado o pagamento, pedimos que entre em contato para confirmarmos o recebimento.</p>

<p>Estamos à disposição para negociar condições de pagamento:</p>
<ul>
    <li>E-mail: {{company.email}}</li>
    <li>Telefone: {{company.phone}}</li>
</ul>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],
            [
                'name' => 'jNotificação de Atraso',
                'context' => 'Overdue',
                'subject' => 'URGENTE: Notificação de Atraso - {{account.reference_number}}',
                'body' => '<h2 style="color: #dc2626;">Notificação Importante de Atraso</h2>

<p>Olá {{customer.name}},</p>

<p>Esta é uma notificação urgente sobre a cobrança em atraso:</p>

<ul>
    <li><strong>Número de Referência:</strong> {{account.reference_number}}</li>
    <li><strong>Valor Original:</strong> {{account.amount}}</li>
    <li><strong>Parcela:</strong> {{account.installment_number}} de {{account.parcels}}</li>
    <li><strong>Data de Vencimento:</strong> {{account.due_date}}</li>
    <li><strong>Dias em Atraso:</strong> <span style="color: #dc2626;">{{account.days_overdue}}</span></li>
</ul>

<p><strong>Valores Atualizados:</strong></p>
<ul>
    <li>Valor Original: {{account.amount}}</li>
    <li>Desconto: {{account.discount_amount}}</li>
    <li>Juros Acumulados: {{account.interest_amount}}</li>
    <li>Multa: {{account.fine_amount}}</li>
    <li><strong style="color: #dc2626;">Total a Pagar: {{account.total_with_fees}}</strong></li>
</ul>

<p><strong>Instruções de Pagamento:</strong><br>
{{account.payment_instructions}}</p>

<p style="color: #dc2626;"><strong>ATENÇÃO:</strong> O não pagamento poderá resultar em medidas adicionais de cobrança e restrições cadastrais.</p>

<p>Por favor, entre em contato <strong>URGENTEMENTE</strong> para regularizar sua situação ou negociar uma forma de pagamento:</p>
<ul>
    <li>E-mail: {{company.email}}</li>
    <li>Telefone: {{company.phone}}</li>
</ul>

<p>Caso já tenha efetuado o pagamento, pedimos que envie o comprovante para {{company.email}}.</p>

<p>Atenciosamente,<br>
{{company.name}}</p>',
                'is_active' => true,
            ],
        ];
    }
}
