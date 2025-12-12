<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class IncompleteRegistrationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private readonly User $user
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
        $daysRegistered = now()->diffInDays($this->user->created_at);

        return (new MailMessage)
            ->subject('Complete seu cadastro e comece a usar o WSoft gratuitamente')
            ->greeting("Olá, {$this->user->name}!")
            ->line('Notamos que você iniciou seu cadastro no WSoft, mas ainda não configurou sua empresa.')
            ->line("Já se passaram {$daysRegistered} dias desde que você criou sua conta, e você ainda tem tempo para aproveitar nosso período de teste gratuito.")
            ->line('Complete seu cadastro agora e comece a experimentar todas as funcionalidades do sistema:')
            ->line('• Gestão completa de clientes')
            ->line('• Controle financeiro integrado')
            ->line('• Relatórios em tempo real')
            ->line('• E muito mais!')
            ->action('Completar Cadastro', route('filament.app.tenant.registration'))
            ->line('Não perca essa oportunidade de modernizar a gestão do seu negócio!')
            ->line('Atenciosamente,')
            ->salutation('Equipe WSoft');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'days_registered' => now()->diffInDays($this->user->created_at),
            'message' => 'Complete seu cadastro e comece a usar o WSoft gratuitamente.',
        ];
    }
}
