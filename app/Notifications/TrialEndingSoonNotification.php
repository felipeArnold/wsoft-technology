<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Laravel\Cashier\Subscription;

final class TrialEndingSoonNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private readonly Tenant $tenant,
        private readonly Subscription $subscription
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $trialEndsAt = $this->subscription->trial_ends_at;
        $daysRemaining = $trialEndsAt ? (int) now()->diffInDays($trialEndsAt, false) : 0;

        return (new MailMessage)
            ->subject('Seu período de teste está acabando')
            ->greeting('Olá!')
            ->line("O período de teste da empresa {$this->tenant->name} está chegando ao fim.")
            ->line("Você tem aproximadamente {$daysRemaining} dias restantes de acesso gratuito.")
            ->line('Para continuar utilizando o sistema após o término do período de teste, certifique-se de que um método de pagamento válido está configurado.')
            ->action('Gerenciar Assinatura', url('/app'))
            ->line('Se você já configurou um método de pagamento, pode ignorar esta mensagem. A cobrança será processada automaticamente.')
            ->line('Obrigado por usar nossa plataforma!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'tenant_id' => $this->tenant->id,
            'tenant_name' => $this->tenant->name,
            'subscription_id' => $this->subscription->id,
            'trial_ends_at' => $this->subscription->trial_ends_at?->toIso8601String(),
            'message' => "O período de teste da empresa {$this->tenant->name} está chegando ao fim.",
        ];
    }
}
