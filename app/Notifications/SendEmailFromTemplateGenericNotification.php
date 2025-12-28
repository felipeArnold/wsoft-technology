<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Enum\Template\TemplateContext;
use App\Models\Accounts\Accounts;
use App\Models\EmailTemplate;
use App\Models\ServiceOrder;
use App\Services\Template\TemplateVariableRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class SendEmailFromTemplateGenericNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private ?EmailTemplate $template = null;

    private ServiceOrder|Accounts|null $model = null;

    public function __construct(
        private readonly int $emailTemplateId,
        private readonly TemplateContext $templateContext,
        private readonly int $modelId,
    ) {
        $this->template = EmailTemplate::find($this->emailTemplateId);

        // Load model based on context
        $this->model = match ($this->templateContext) {
            TemplateContext::ServiceOrder => ServiceOrder::with(['person', 'tenant', 'user'])->find($this->modelId),
            TemplateContext::AccountsPayable,
            TemplateContext::AccountsReceivable,
            TemplateContext::Overdue => Accounts::with(['person', 'tenant', 'user'])->find($this->modelId),
        };
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        if (! $this->template || ! $this->model) {
            return (new MailMessage)
                ->subject('Erro ao enviar email')
                ->line('Não foi possível processar o template de email.');
        }

        // Prepare data for template rendering
        $data = match ($this->templateContext) {
            TemplateContext::ServiceOrder => ['serviceOrder' => $this->model],
            TemplateContext::AccountsPayable,
            TemplateContext::AccountsReceivable,
            TemplateContext::Overdue => ['account' => $this->model],
        };

        // Render subject and body using TemplateVariableRegistry
        $subject = TemplateVariableRegistry::render(
            $this->template->subject,
            $this->templateContext,
            $data
        );

        $body = TemplateVariableRegistry::render(
            $this->template->body,
            $this->templateContext,
            $data
        );

        return (new MailMessage)
            ->subject($subject)
            ->markdown('emails.template', [
                'body' => $body,
                'model' => $this->model,
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'email_template_id' => $this->emailTemplateId,
            'template_context' => $this->templateContext->value,
            'model_id' => $this->modelId,
        ];
    }
}
