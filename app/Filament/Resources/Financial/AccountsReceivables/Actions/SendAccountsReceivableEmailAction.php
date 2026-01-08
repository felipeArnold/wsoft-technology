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

final class SendAccountsReceivableEmailAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Enviar por Email')
            ->color(Color::Emerald)
            ->icon('heroicon-o-envelope')
            ->modalHeading('Enviar Email - Contas a Receber')
            ->modalDescription('Selecione o template que deseja utilizar para enviar este e-mail:')
            ->modalSubmitActionLabel('Enviar')
            ->modalWidth('md')
            ->form($this->getFormSchema())
            ->action(fn (array $data) => $this->execute($data));
    }

    public static function make(?string $name = 'send_email'): static
    {
        return parent::make($name);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('email_template_id')
                ->label('Template de E-mail')
                ->searchable()
                ->lazy()
                ->required()
                ->options(fn (): array => EmailTemplate::query()
                    ->where('context', TemplateContext::AccountsReceivable->value)
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->all()
                )
                ->placeholder('Selecione um template')
                ->helperText('Somente templates ativos do contexto "Contas a Receber" são listados.'),
        ];
    }

    protected function execute(array $data): void
    {
        /** @var Accounts|null $record */
        $record = $this->getRecord();

        if (! $record) {
            Notification::make()
                ->title('Erro')
                ->body('Conta a receber não encontrada.')
                ->danger()
                ->send();

            return;
        }

        $templateId = (int) ($data['email_template_id'] ?? 0);

        // Get email from person (customer)
        $email = $record->person?->emails()
            ->first()
            ->address ?? null;

        if (empty($email)) {
            Notification::make()
                ->title('Nenhum e-mail encontrado')
                ->body('O cliente não possui e-mails cadastrados. Cadastre um e tente novamente.')
                ->danger()
                ->send();

            return;
        }

        $template = EmailTemplate::query()
            ->where('id', $templateId)
            ->where('context', TemplateContext::AccountsReceivable->value)
            ->first();

        if (! $template) {
            Notification::make()
                ->title('Template inválido')
                ->body('O template selecionado não é válido para Contas a Receber.')
                ->danger()
                ->send();

            return;
        }

        // Send email using Laravel Notification
        (new AnonymousNotifiable)
            ->route('mail', $email)
            ->notify(new SendEmailFromTemplateGenericNotification(
                emailTemplateId: $templateId,
                templateContext: TemplateContext::AccountsReceivable,
                modelId: $record->id,
            ));

        Notification::make()
            ->title('E-mail enfileirado')
            ->body('O envio foi adicionado à fila e será processado em breve.')
            ->success()
            ->send();
    }
}
