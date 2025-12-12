<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Pages;

use App\Filament\Resources\Services\ServiceOrders\ServiceOrderResource;
use App\Mail\SendEmailFromTemplateMail;
use App\Models\Accounts\Accounts;
use App\Models\EmailTemplate;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Mail;

final class ViewServiceOrder extends ViewRecord
{
    protected static string $resource = ServiceOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Action: enviar email com seleção de template em modal
            Action::make('send_email')
                ->label('Enviar por Email')
                ->hidden()
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

                    // first email addresses from related person
                    $email = $this->record->person?->emails()
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

                    $template = EmailTemplate::find($templateId);

                    $context = $template?->body;

                    Mail::to($email)
                        ->send(new SendEmailFromTemplateMail(
                            emailTemplateId: $templateId,
                            serviceOrderId: $this->record->id,
                            context: $context,
                        ));

                    Notification::make()
                        ->title('E-mail enfileirado')
                        ->body('O envio foi adicionado à fila e será processado em breve.')
                        ->success()
                        ->send();
                }),

            // Action: gerar PDF da ordem de serviço
            Action::make('download_pdf')
                ->label('Gerar PDF')
                ->color(Color::Blue)
                ->icon('heroicon-o-document-arrow-down')
                ->action(function (): \Symfony\Component\HttpFoundation\Response {
                    $serviceOrder = $this->record->load([
                        'person',
                        'user',
                        'tenant',
                        'serviceOrderServices',
                        'serviceOrderProducts',
                    ]);

                    $pdf = Pdf::loadView('pdf.service-order', [
                        'serviceOrder' => $serviceOrder,
                        'tenant' => $serviceOrder->tenant,
                    ])
                        ->setPaper('a4')
                        ->setOption('margin-top', 10)
                        ->setOption('margin-bottom', 10)
                        ->setOption('margin-left', 10)
                        ->setOption('margin-right', 10);

                    return response()->streamDownload(
                        fn () => print ($pdf->output()),
                        'ordem-servico-'.$serviceOrder->number.'.pdf'
                    );
                }),

            // Action: criar conta a receber
            Action::make('create_account_receivable')
                ->label('Gerar Conta a Receber')
                ->color(Color::Emerald)
                ->icon('heroicon-o-currency-dollar')
                ->modalHeading('Gerar Conta a Receber')
                ->modalDescription('Configure as parcelas e método de pagamento:')
                ->modalSubmitActionLabel('Gerar Conta')
                ->modalWidth('md')
                ->visible(fn () => $this->record->total_value > 0 && $this->record->person_id !== null)
                ->form([
                    Forms\Components\Select::make('parcels')
                        ->label('Parcelas')
                        ->options([
                            '1' => 'À vista',
                            '2' => '2x',
                            '3' => '3x',
                            '4' => '4x',
                            '5' => '5x',
                            '6' => '6x',
                            '7' => '7x',
                            '8' => '8x',
                            '9' => '9x',
                            '10' => '10x',
                            '12' => '12x',
                        ])
                        ->default('1')
                        ->native(false)
                        ->required(),
                    Forms\Components\TextInput::make('days_to_pay')
                        ->label('Dia do vencimento')
                        ->numeric()
                        ->default((int) now()->format('d'))
                        ->minValue(1)
                        ->maxValue(31)
                        ->maxLength(2)
                        ->required()
                        ->helperText('Dia do mês para vencimento das parcelas'),
                    Forms\Components\Select::make('payment_method')
                        ->label('Método de pagamento')
                        ->options([
                            'cash' => 'Dinheiro',
                            'card' => 'Cartão',
                            'pix' => 'PIX',
                            'bank_transfer' => 'Transferência Bancária',
                            'check' => 'Cheque',
                            'boleto' => 'Boleto',
                            'debit_card' => 'Cartão de Débito',
                            'credit_card' => 'Cartão de Crédito',
                        ])
                        ->default('pix')
                        ->native(false)
                        ->required(),
                ])
                ->action(function (array $data): void {
                    // Create account receivable
                    $account = Accounts::query()->create([
                        'tenant_id' => Filament::getTenant()->id,
                        'user_id' => $this->record->user_id,
                        'person_id' => $this->record->person_id,
                        'service_order_id' => $this->record->id,
                        'type' => 'receivables',
                        'amount' => $this->record->total_value,
                        'parcels' => (int) $data['parcels'],
                        'days_to_pay' => (int) $data['days_to_pay'],
                        'status' => 'pending',
                        'payment_method' => $data['payment_method'],
                        'category' => 'Ordem de Serviço',
                        'reference_number' => $this->record->number ?? "OS-{$this->record->id}",
                        'notes' => $this->record->description,
                    ]);

                    // Create installments
                    $installmentsCount = (int) $data['parcels'];
                    $totalCents = (int) round($this->record->total_value * 100);
                    $baseCents = intdiv($totalCents, $installmentsCount);
                    $firstCents = $totalCents - ($baseCents * ($installmentsCount - 1));
                    $dayOfMonth = (int) $data['days_to_pay'];

                    for ($i = 0; $i < $installmentsCount; $i++) {
                        $dueDate = now()
                            ->copy()
                            ->startOfMonth()
                            ->addMonths($i)
                            ->day($dayOfMonth);

                        $account->installments()->create([
                            'tenant_id' => Filament::getTenant()->id,
                            'installment_number' => $i + 1,
                            'amount' => ($i === 0 ? $firstCents : $baseCents) / 100,
                            'due_date' => $dueDate,
                            'status' => 0,
                        ]);
                    }

                    Notification::make()
                        ->title('Conta a receber criada com sucesso')
                        ->success()
                        ->body('A conta a receber foi gerada a partir da ordem de serviço.')
                        ->send();
                }),

            EditAction::make()
                ->label('Editar')
                ->icon('heroicon-o-pencil')
                ->modalWidth('2xl'),
        ];
    }
}
