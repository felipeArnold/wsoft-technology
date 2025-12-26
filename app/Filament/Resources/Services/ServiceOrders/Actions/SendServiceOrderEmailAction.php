<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Actions;

use App\Models\EmailTemplate;
use App\Models\ServiceOrder;
use App\Notifications\SendEmailFromTemplateNotification;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Illuminate\Notifications\AnonymousNotifiable;

final class SendServiceOrderEmailAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Enviar por Email')
            ->color(Color::Emerald)
            ->icon('heroicon-o-envelope')
            ->modalHeading('Enviar por Email')
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
                ->preload()
                ->required()
                ->options(fn (): array => EmailTemplate::query()
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->all()
                ),
        ];
    }

    protected function execute(array $data): void
    {
        /** @var ServiceOrder|null $record */
        $record = $this->getRecord();

        if (! $record) {
            Notification::make()
                ->title('Erro')
                ->body('Ordem de serviço não encontrada.')
                ->danger()
                ->send();

            return;
        }

        $templateId = (int) ($data['email_template_id'] ?? 0);

        // first email addresses from related person
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

        $template = EmailTemplate::query()->find($templateId);

        $context = $template?->body;

        // Send email using Laravel Notification
        (new AnonymousNotifiable)
            ->route('mail', $email)
            ->notify(new SendEmailFromTemplateNotification(
                emailTemplateId: $templateId,
                serviceOrderId: $record->id,
                context: $context,
            ));

        Notification::make()
            ->title('E-mail enfileirado')
            ->body('O envio foi adicionado à fila e será processado em breve.')
            ->success()
            ->send();
    }
}
