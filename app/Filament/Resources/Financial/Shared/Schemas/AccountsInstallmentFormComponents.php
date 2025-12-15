<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Shared\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Leandrocfe\FilamentPtbrFormFields\Money;

final class AccountsInstallmentFormComponents
{
    public static function getInstallmentSection(): Section
    {
        return Section::make('Informações da Parcela')
            ->icon('heroicon-o-banknotes')
            ->schema([
                Grid::make(3)
                    ->schema([
                        TextInput::make('installment_number')
                            ->label('Número da Parcela')
                            ->disabled()
                            ->numeric(),
                        Money::make('amount')
                            ->label('Valor da Parcela')
                            ->disabled(),
                        DatePicker::make('due_date')
                            ->label('Data de Vencimento')
                            ->disabled()
                            ->native(false),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                0 => 'Pendente',
                                1 => 'Pago',
                                2 => 'Vencido',
                            ])
                            ->native(false)
                            ->disabled(),
                        DatePicker::make('paid_at')
                            ->label('Data de Pagamento')
                            ->disabled()
                            ->native(false),
                    ]),
            ])
            ->columnSpanFull();
    }

    public static function getAccountSection(): Section
    {
        return Section::make('Informações da Conta')
            ->icon('heroicon-o-document-text')
            ->schema([
                Grid::make(3)
                    ->schema([
                        Select::make('accounts.type')
                            ->label('Tipo')
                            ->options([
                                'receivables' => 'Contas a Receber',
                                'payables' => 'Contas a Pagar',
                            ])
                            ->native(false)
                            ->disabled(),
                        Select::make('accounts.person_id')
                            ->label('Cliente/Fornecedor')
                            ->relationship('accounts.person', 'name')
                            ->disabled(),
                        Select::make('accounts.user_id')
                            ->label('Responsável')
                            ->relationship('accounts.user', 'name')
                            ->disabled(),
                        Select::make('accounts.payment_method')
                            ->label('Forma de Pagamento')
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
                            ->native(false)
                            ->disabled(),
                        TextInput::make('accounts.reference_number')
                            ->label('Número de Referência')
                            ->disabled(),
                        TextInput::make('accounts.parcels')
                            ->label('Total de Parcelas')
                            ->disabled(),
                    ]),
            ])
            ->columnSpanFull();
    }

    public static function getAccountValuesSection(): Section
    {
        return Section::make('Valores da Conta')
            ->icon('heroicon-o-calculator')
            ->schema([
                Grid::make(4)
                    ->schema([
                        Money::make('accounts.amount')
                            ->label('Valor Total')
                            ->disabled(),
                        Money::make('accounts.discount_amount')
                            ->label('Desconto')
                            ->disabled(),
                        Money::make('accounts.interest_amount')
                            ->label('Juros')
                            ->disabled(),
                        Money::make('accounts.fine_amount')
                            ->label('Multa')
                            ->disabled(),
                    ]),
            ])
            ->columnSpanFull()
            ->collapsed();
    }

    public static function getServiceOrderSection(): Section
    {
        return Section::make('Ordem de Serviço')
            ->icon('heroicon-o-clipboard-document-list')
            ->schema([
                Grid::make(3)
                    ->schema([
                        TextInput::make('accounts.serviceOrder.number')
                            ->label('Número da OS')
                            ->disabled(),
                        Select::make('accounts.service_order_id')
                            ->label('Status da OS')
                            ->relationship('accounts.serviceOrder', 'status')
                            ->disabled()
                            ->formatStateUsing(fn ($state) => match ($state) {
                                'draft' => 'Rascunho',
                                'in_progress' => 'Em Andamento',
                                'completed' => 'Concluída',
                                'cancelled' => 'Cancelada',
                                default => $state,
                            }),
                        Money::make('accounts.serviceOrder.total_value')
                            ->label('Valor Total da OS')
                            ->disabled(),
                    ]),
            ])
            ->columnSpanFull()
            ->collapsed()
            ->hidden(fn ($record) => ! $record?->accounts?->service_order_id);
    }

    public static function getNotesSection(): Section
    {
        return Section::make('Observações')
            ->icon('heroicon-o-document-text')
            ->schema([
                RichEditor::make('accounts.notes')
                    ->label('Observações')
                    ->disabled()
                    ->columnSpanFull(),
            ])
            ->columnSpanFull()
            ->collapsed();
    }

    public static function getAllComponents(): array
    {
        return [
            self::getInstallmentSection(),
            self::getAccountSection(),
            self::getAccountValuesSection(),
            self::getServiceOrderSection(),
            self::getNotesSection(),
        ];
    }
}
