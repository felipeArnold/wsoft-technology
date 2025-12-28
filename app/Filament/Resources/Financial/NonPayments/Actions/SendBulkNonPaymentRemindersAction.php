<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\NonPayments\Actions;

use App\Enum\Template\TemplateContext;
use App\Models\Accounts\AccountsInstallments;
use App\Models\EmailTemplate;
use App\Notifications\SendEmailFromTemplateGenericNotification;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Collection;

final class SendBulkNonPaymentRemindersAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Enviar Lembretes')
            ->icon('heroicon-o-envelope')
            ->color('warning')
            ->requiresConfirmation()
            ->modalHeading('Enviar Lembretes em Lote')
            ->modalDescription('Selecione o template que deseja utilizar para enviar os lembretes:')
            ->modalSubmitActionLabel('Enviar')
            ->modalWidth('md')
            ->form($this->getFormSchema())
            ->action(fn (array $data) => $this->execute($data));
    }

    public static function make(?string $name = 'send_bulk_reminders'): static
    {
        return parent::make($name);
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
        /** @var Collection|null $records */
        $records = $this->getRecords();

        if (! $records || $records->isEmpty()) {
            Notification::make()
                ->title('Erro')
                ->body('Nenhuma parcela selecionada.')
                ->danger()
                ->send();

            return;
        }

        $templateId = (int) ($data['email_template_id'] ?? 0);

        $template = EmailTemplate::query()
            ->where('id', $templateId)
            ->where('context', TemplateContext::Overdue->value)
            ->first();

        if (! $template) {
            Notification::make()
                ->title('Template inválido')
                ->body('O template selecionado não é válido para lembretes de inadimplência.')
                ->danger()
                ->send();

            return;
        }

        $sent = 0;
        $skipped = 0;

        /** @var AccountsInstallments $record */
        foreach ($records as $record) {
            // Get email address from related person through accounts
            $email = $record->accounts?->person?->emails()
                ->first()
                ->address ?? null;

            if (empty($email)) {
                $skipped++;

                continue;
            }

            // Send email using Laravel Notification
            (new AnonymousNotifiable)
                ->route('mail', $email)
                ->notify(new SendEmailFromTemplateGenericNotification(
                    emailTemplateId: $templateId,
                    templateContext: TemplateContext::Overdue,
                    modelId: $record->accounts->id,
                ));

            $sent++;
        }

        $message = 'foram adicionados à fila';
        if ($sent === 1) {
            $message = 'foi adicionado à fila';
        }

        $body = "{$sent} lembrete(s) {$message} e será(ão) processado(s) em breve.";

        if ($skipped > 0) {
            $body .= " {$skipped} parcela(s) foram ignoradas por não possuírem e-mail cadastrado.";
        }

        Notification::make()
            ->title('Lembretes enfileirados')
            ->body($body)
            ->success()
            ->send();
    }
}
