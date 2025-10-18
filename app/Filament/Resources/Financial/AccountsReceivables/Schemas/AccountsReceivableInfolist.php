<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsReceivables\Schemas;

use Filament\Schemas\Schema;

final class AccountsReceivableInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                //                Tabs::make('receivable_tabs')
                //                    ->columnSpanFull()
                //                    ->tabs([
                //                        Tab::make('details')
                //                            ->label('Dados da Conta a Receber')
                //                            ->icon('heroicon-o-arrow-up-circle')
                //                            ->schema([
                //                                Split::make([
                //                                    Section::make('Informações Básicas')
                //                                        ->description('Dados principais da conta a receber')
                //                                        ->icon('heroicon-o-information-circle')
                //                                        ->schema([
                //                                            TextEntry::make('reference_number')
                //                                                ->label('Número de Referência')
                //                                                ->placeholder('—'),
                //                                            TextEntry::make('category')
                //                                                ->label('Categoria')
                //                                                ->placeholder('—'),
                //                                            TextEntry::make('status')
                //                                                ->label('Status')
                //                                                ->badge()
                //                                                ->color(fn (string $state): string => match ($state) {
                //                                                    'paid' => 'success',
                //                                                    'overdue' => 'danger',
                //                                                    'pending' => 'warning',
                //                                                    'cancelled' => 'gray',
                //                                                    default => 'gray',
                //                                                })
                //                                                ->formatStateUsing(fn (string $state): string => match ($state) {
                //                                                    'paid' => 'Recebido',
                //                                                    'overdue' => 'Vencido',
                //                                                    'pending' => 'Pendente',
                //                                                    'cancelled' => 'Cancelado',
                //                                                    default => $state,
                //                                                }),
                //                                            TextEntry::make('payment_method')
                //                                                ->label('Forma de Pagamento')
                //                                                ->badge()
                //                                                ->color(fn (string $state): string => match ($state) {
                //                                                    'pix' => 'success',
                //                                                    'cash' => 'warning',
                //                                                    'card' => 'info',
                //                                                    'bank_transfer' => 'primary',
                //                                                    'check' => 'secondary',
                //                                                    'boleto' => 'danger',
                //                                                    'debit_card' => 'info',
                //                                                    'credit_card' => 'info',
                //                                                    default => 'gray',
                //                                                })
                //                                                ->formatStateUsing(fn (string $state): string => match ($state) {
                //                                                    'cash' => 'Dinheiro',
                //                                                    'card' => 'Cartão',
                //                                                    'pix' => 'PIX',
                //                                                    'bank_transfer' => 'Transferência Bancária',
                //                                                    'check' => 'Cheque',
                //                                                    'boleto' => 'Boleto',
                //                                                    'debit_card' => 'Cartão de Débito',
                //                                                    'credit_card' => 'Cartão de Crédito',
                //                                                    default => $state,
                //                                                }),
                //                                        ]),
                //                                    Section::make('Cliente')
                //                                        ->description('Dados do cliente')
                //                                        ->icon('heroicon-o-user')
                //                                        ->schema([
                //                                            TextEntry::make('person.name')
                //                                                ->label('Nome')
                //                                                ->weight('bold'),
                //                                            TextEntry::make('person.document')
                //                                                ->label('CPF/CNPJ')
                //                                                ->placeholder('—'),
                //                                            TextEntry::make('person.profession')
                //                                                ->label('Profissão')
                //                                                ->placeholder('—'),
                //                                        ]),
                //                                ]),
                //                            ]),
                //                        Tab::make('financial')
                //                            ->label('Informações Financeiras')
                //                            ->icon('heroicon-o-currency-dollar')
                //                            ->schema([
                //                                Split::make([
                //                                    Section::make('Valores')
                //                                        ->description('Valores da conta a receber')
                //                                        ->icon('heroicon-o-calculator')
                //                                        ->schema([
                //                                            TextEntry::make('amount')
                //                                                ->label('Valor Total')
                //                                                ->money('BRL')
                //                                                ->weight('bold')
                //                                                ->size('lg'),
                //                                            TextEntry::make('amount_paid')
                //                                                ->label('Valor Recebido')
                //                                                ->money('BRL')
                //                                                ->color('success'),
                //                                            TextEntry::make('discount_amount')
                //                                                ->label('Desconto')
                //                                                ->money('BRL')
                //                                                ->color('success')
                //                                                ->placeholder('R$ 0,00'),
                //                                            TextEntry::make('interest_amount')
                //                                                ->label('Juros')
                //                                                ->money('BRL')
                //                                                ->color('danger')
                //                                                ->placeholder('R$ 0,00'),
                //                                            TextEntry::make('fine_amount')
                //                                                ->label('Multa')
                //                                                ->money('BRL')
                //                                                ->color('danger')
                //                                                ->placeholder('R$ 0,00'),
                //                                        ]),
                //                                    Section::make('Parcelas')
                //                                        ->description('Detalhamento das parcelas')
                //                                        ->icon('heroicon-o-list-bullet')
                //                                        ->schema([
                //                                            TextEntry::make('parcels')
                //                                                ->label('Número de Parcelas')
                //                                                ->formatStateUsing(fn (string $state): string => $state.'x'),
                //                                            TextEntry::make('days_to_pay')
                //                                                ->label('Dia do Vencimento')
                //                                                ->formatStateUsing(fn (string $state): string => 'Dia '.$state),
                //                                            TextEntry::make('recurring')
                //                                                ->label('Recorrente')
                //                                                ->badge()
                //                                                ->color(fn (string $state): string => $state === 'yes' ? 'success' : 'gray')
                //                                                ->formatStateUsing(fn (string $state): string => $state === 'yes' ? 'Sim' : 'Não'),
                //                                        ]),
                //                                ]),
                //                            ]),
                //                        Tab::make('installments')
                //                            ->label('Parcelas Detalhadas')
                //                            ->icon('heroicon-o-list-bullet')
                //                            ->schema([
                //                                Section::make('Parcelas')
                //                                    ->description('Detalhamento de cada parcela')
                //                                    ->icon('heroicon-o-calculator')
                //                                    ->schema([
                //                                        TextEntry::make('installments')
                //                                            ->label('')
                //                                            ->formatStateUsing(function ($record) {
                //                                                if (! $record->installments || $record->installments->isEmpty()) {
                //                                                    return 'Nenhuma parcela cadastrada';
                //                                                }
                //
                //                                                $installments = $record->installments->map(function ($installment) {
                //                                                    $status = match ($installment->status) {
                //                                                        1 => '✅ Recebido',
                //                                                        2 => '❌ Vencido',
                //                                                        default => '⏳ Pendente',
                //                                                    };
                //
                //                                                    return sprintf(
                //                                                        'Parcela %d: %s - %s (%s)',
                //                                                        $installment->installment_number,
                //                                                        'R$ '.number_format($installment->amount, 2, ',', '.'),
                //                                                        \Carbon\Carbon::parse($installment->due_date)->format('d/m/Y'),
                //                                                        $status
                //                                                    );
                //                                                })->join("\n");
                //
                //                                                return $installments;
                //                                            })
                //                                            ->markdown()
                //                                            ->columnSpanFull(),
                //                                    ]),
                //                            ]),
                //                        Tab::make('attachments')
                //                            ->label('Anexos')
                //                            ->icon('heroicon-o-paper-clip')
                //                            ->schema([
                //                                Section::make('Documentos')
                //                                    ->description('Documentos anexados')
                //                                    ->icon('heroicon-o-document')
                //                                    ->schema([
                //                                        TextEntry::make('attachment')
                //                                            ->label('Anexos')
                //                                            ->formatStateUsing(function ($record) {
                //                                                if (! $record->attachment || empty($record->attachment)) {
                //                                                    return 'Nenhum documento anexado';
                //                                                }
                //
                //                                                $attachments = is_array($record->attachment) ? $record->attachment : [$record->attachment];
                //
                //                                                return count($attachments).' documento(s) anexado(s)';
                //                                            })
                //                                            ->placeholder('Nenhum documento anexado'),
                //                                    ]),
                //                            ]),
                //                        Tab::make('notes')
                //                            ->label('Observações')
                //                            ->icon('heroicon-o-document-text')
                //                            ->schema([
                //                                Section::make('Informações Adicionais')
                //                                    ->description('Observações e detalhes extras')
                //                                    ->icon('heroicon-o-chat-bubble-left-right')
                //                                    ->schema([
                //                                        TextEntry::make('notes')
                //                                            ->label('Descrição')
                //                                            ->markdown()
                //                                            ->placeholder('Nenhuma observação adicionada')
                //                                            ->columnSpanFull(),
                //                                        TextEntry::make('payment_instructions')
                //                                            ->label('Instruções de Pagamento')
                //                                            ->markdown()
                //                                            ->placeholder('Nenhuma instrução de pagamento')
                //                                            ->columnSpanFull(),
                //                                    ]),
                //                            ]),
                //                    ]),
            ]);
    }
}
