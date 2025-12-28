<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\EmailTemplate;
use App\Models\ServiceOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class SendEmailFromTemplateNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private ?EmailTemplate $template = null;

    private ?ServiceOrder $serviceOrder = null;

    public function __construct(
        private readonly int $emailTemplateId,
        private readonly int $serviceOrderId,
        private readonly ?string $context = null
    ) {
        $this->template = EmailTemplate::query()->find($this->emailTemplateId);
        $this->serviceOrder = ServiceOrder::query()->with(['person', 'tenant', 'user'])
            ->find($this->serviceOrderId);
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        if (! $this->template || ! $this->serviceOrder) {
            return (new MailMessage)
                ->subject('Erro ao enviar email')
                ->line('Não foi possível processar o template de email.');
        }

        $subject = $this->replaceVariables($this->template->subject);
        $body = $this->replaceVariables($this->context ?? $this->template->body);

        return (new MailMessage)
            ->subject($subject)
            ->markdown('emails.template', [
                'body' => $body,
                'serviceOrder' => $this->serviceOrder,
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'email_template_id' => $this->emailTemplateId,
            'service_order_id' => $this->serviceOrderId,
        ];
    }

    private function replaceVariables(string $content): string
    {
        if (! $this->serviceOrder) {
            return $content;
        }

        $variables = [
            // Service Order variables
            '{{service_order.number}}' => $this->serviceOrder->number ?? '',
            '{{service_order.status}}' => $this->serviceOrder->status?->getLabel() ?? '',
            '{{service_order.priority}}' => $this->serviceOrder->priority?->getLabel() ?? '',
            '{{service_order.opening_date}}' => $this->serviceOrder->opening_date?->format('d/m/Y') ?? '',
            '{{service_order.expected_completion_date}}' => $this->serviceOrder->expected_completion_date?->format('d/m/Y') ?? '',
            '{{service_order.completion_date}}' => $this->serviceOrder->completion_date?->format('d/m/Y') ?? '',
            '{{service_order.total_value}}' => 'R$ '.number_format($this->serviceOrder->total_value ?? 0, 2, ',', '.'),
            '{{service_order.labor_value}}' => 'R$ '.number_format($this->serviceOrder->labor_value ?? 0, 2, ',', '.'),
            '{{service_order.parts_value}}' => 'R$ '.number_format($this->serviceOrder->parts_value ?? 0, 2, ',', '.'),
            '{{service_order.description}}' => $this->serviceOrder->description ?? '',
            '{{service_order.observations}}' => $this->serviceOrder->observations ?? '',

            // Customer variables
            '{{customer.name}}' => $this->serviceOrder->person?->name ?? '',
            '{{customer.email}}' => $this->serviceOrder->person?->emails?->first()?->address ?? '',

            // Company variables
            '{{company.name}}' => $this->serviceOrder->tenant?->name ?? '',
            '{{company.email}}' => $this->serviceOrder->tenant?->email ?? '',
            '{{company.phone}}' => $this->serviceOrder->tenant?->phone ?? '',
        ];

        return str_replace(
            array_keys($variables),
            array_values($variables),
            $content
        );
    }
}
