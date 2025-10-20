<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Pages;

use App\Filament\Resources\Services\ServiceOrders\ServiceOrderResource;
use App\Jobs\SendEmailFromTemplate;
use App\Models\EmailTemplate;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;

final class ViewServiceOrder extends ViewRecord
{
    protected static string $resource = ServiceOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Action: enviar email com seleção de template em modal
            Action::make('send_email')
                ->label('Enviar por Email')
                ->color(Color::Emerald)
                ->icon('heroicon-o-envelope')
                ->modalHeading('Enviar por Email')
                ->modalDescription('Selecione o template que deseja utilizar para enviar este e-mail:')
                ->modalSubmitActionLabel('Enviar')
                ->form([
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
                ])
                ->action(function (array $data): void {
                    $templateId = (int) ($data['email_template_id'] ?? 0);

                    // Busca e-mails do cliente associado à ordem de serviço
                    $emails = $this->record->person?->emails()
                        ->pluck('address')
                        ->filter()
                        ->unique()
                        ->values()
                        ->all();

                    if (empty($emails)) {
                        Notification::make()
                            ->title('Nenhum e-mail encontrado')
                            ->body('O cliente não possui e-mails cadastrados. Cadastre um e tente novamente.')
                            ->danger()
                            ->send();

                        return;
                    }

                    // Monta um contexto básico para o template (pode ser expandido depois)
                    $context = [
                        'serviceOrder' => $this->record,
                        'person' => $this->record->person,
                        'user' => $this->record->user,
                    ];

                    dispatch(new SendEmailFromTemplate(
                        emailTemplateId: $templateId,
                        to: $emails,
                        context: $context,
                    ));

                    Notification::make()
                        ->title('E-mail enfileirado')
                        ->body('O envio foi adicionado à fila e será processado em breve.')
                        ->success()
                        ->send();
                }),
            EditAction::make()
                ->label('Editar')
                ->icon('heroicon-o-pencil')
                ->modalWidth('2xl'),
        ];
    }
}
