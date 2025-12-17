<?php

declare(strict_types=1);

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class NewUserRegistered extends Notification
{
    use Queueable;

    private $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

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
        $billingDate = Carbon::now()->addDays(7);
        $formattedDate = $billingDate->format('d/m/Y');

        return (new MailMessage)
            ->subject('Bem-vindo ao '.config('app.name').' - Seu teste de 7 dias começou!')
            ->greeting('Olá, '.$this->user->name.'! 👋')
            ->line('Parabéns! Seu cadastro foi realizado com sucesso.')
            ->line('**Você tem 7 dias para testar TODAS as funcionalidades, sem limitações**')
            ->line('---')
            ->line('**💳 IMPORTANTE: Primeira cobrança somente em '.$formattedDate.' (daqui a 7 dias)**')
            ->line('Valor: **R$ 29,90/mês** (sem contratos ou taxas ocultas)')
            ->line('---')
            ->line('Durante este período de teste, você pode:')
            ->line('✓ Criar e gerenciar Ordens de Serviço')
            ->line('✓ Controlar suas Contas a Pagar e Receber')
            ->line('✓ Gerenciar seu Estoque e Produtos')
            ->line('✓ Cadastrar Clientes e Fornecedores')
            ->line('✓ Visualizar Relatórios e Dashboards em tempo real')
            ->action('Começar a usar agora', url('/app'))
            ->line('💡 **Dica:** Configure sua empresa primeiro e depois explore as funcionalidades. Se precisar de ajuda, estamos aqui!')
            ->line('📱 **Suporte:** Entre em contato conosco via WhatsApp se tiver qualquer dúvida.')
            ->line('🔒 **Garantia:** Cancele quando quiser, sem multas ou burocracia. Seus dados estão seguros conosco.')
            ->salutation('Sucesso na sua jornada! Equipe '.config('app.name'));
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
            'user_email' => $this->user->email,
        ];
    }
}
