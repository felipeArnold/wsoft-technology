<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsReceivables\Actions;

use App\Enum\Template\TemplateContext;
use App\Models\Accounts\Accounts;
use App\Models\EmailTemplate;
use App\Notifications\SendEmailFromTemplateGenericNotification;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Illuminate\Notifications\AnonymousNotifiable;

final class SendOverdueEmailAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Enviar Aviso de Inadimplência')
            ->color(Color::Red)
            ->icon('heroicon-o-exclamation-triangle')
            ->modalHeading('Enviar Aviso de Inadimplência')
            ->modalDescription('Selecione o template de aviso de inadimplência que deseja enviar:')
            ->modalSubmitActionLabel('Enviar Aviso')
            ->modalWidth('md')
            ->form($this->getFormSchema())
            ->action(fn (array $data) => $this->execute($data))
            ->visible(fn () => $this->canSendOverdueEmail());
    }

    public static function make(?string $name = 'send_overdue_email'): static
    {
        return parent::make($name);
    }

    protected function canSendOverdueEmail(): bool
    {
        /** @var Accounts|null $record */
        $record = $this->getRecord();

        if (! $record) {
            return false;
        }

        // Only show for overdue accounts
        return $record->status === 'overdue';
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('email_template_id')
                ->label('Template de E-mail')
                ->searchable()
                ->preload()
                ->required()
                ->options(fn (): array => EmailTemplate::query()
                    ->where('context', TemplateContext::Overdue->value)
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->all()
                )
                ->placeholder('Selecione um template')
                ->helperText('Somente templates ativos do contexto "Inadimplência" são listados.'),
        ];
    }

    protected function execute(array $data): void
    {
        /** @var Accounts|null $record */
        $record = $this->getRecord();

        if (! $record) {
            Notification::make()
                ->title('Erro')
                ->body('Conta não encontrada.')
                ->danger()
                ->send();

            return;
        }

        // Verify account is actually overdue
        if ($record->status !== 'overdue') {
            Notification::make()
                ->title('Conta não está em atraso')
                ->body('Esta ação só pode ser executada para contas em atraso.')
                ->warning()
                ->send();

            return;
        }

        $templateId = (int) ($data['email_template_id'] ?? 0);

        // Get email from person (customer for receivables, supplier for payables)
        $email = $record->person?->emails()
            ->first()
            ->address ?? null;

        if (empty($email)) {
            Notification::make()
                ->title('Nenhum e-mail encontrado')
                ->body('O destinatário não possui e-mails cadastrados. Cadastre um e tente novamente.')
                ->danger()
                ->send();

            return;
        }

        $template = EmailTemplate::query()
            ->where('id', $templateId)
            ->where('context', TemplateContext::Overdue->value)
            ->first();

        if (! $template) {
            Notification::make()
                ->title('Template inválido')
                ->body('O template selecionado não é válido para Inadimplência.')
                ->danger()
                ->send();

            return;
        }

        // Send email using Laravel Notification
        (new AnonymousNotifiable)
            ->route('mail', $email)
            ->notify(new SendEmailFromTemplateGenericNotification(
                emailTemplateId: $templateId,
                templateContext: TemplateContext::Overdue,
                modelId: $record->id,
            ));

        Notification::make()
            ->title('Aviso de inadimplência enviado')
            ->body('O envio foi adicionado à fila e será processado em breve.')
            ->success()
            ->send();
    }
}
