<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class MultiFactorAuthenticationCode extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private readonly string $code
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Código de Autenticação - '.config('app.name'))
            ->greeting('Olá!, '.$notifiable->name)
            ->line('Você está recebendo este e-mail porque uma solicitação de autenticação de dois fatores foi iniciada para sua conta.')
            ->line('Seu código de verificação é:')
            ->line('**'.$this->code.'**')
            ->line('Este código expira em 2 minutos.')
            ->line('Se você não solicitou este código, por favor, ignore este e-mail e certifique-se de que sua conta está segura.')
            ->salutation('Atenciosamente, Equipe '.config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'code' => $this->code,
        ];
    }
}
