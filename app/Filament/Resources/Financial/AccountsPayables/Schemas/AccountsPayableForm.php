<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsPayables\Schemas;

use App\Helpers\FormatterHelper;
use App\Models\Person\Person;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\Money;

final class AccountsPayableForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('type')->default('payables'),
                Tabs::make('receivable_tabs')
                    ->columnSpanFull()
                    ->vertical()
                    ->tabs([
                        Tab::make('details')
                            ->label('Dados da Conta a pagar')
                            ->icon('heroicon-o-arrow-up-circle')
                            ->schema([
                                Section::make('Informações Básicas')
                                    ->description('Dados principais da conta a pagar')
                                    ->icon('heroicon-o-information-circle')
                                    ->schema([
                                        Grid::make(12)
                                            ->schema([
                                                ToggleButtons::make('status')
                                                    ->label('Status')
                                                    ->options([
                                                        'pending' => 'Pendente',
                                                        'paid' => 'Pago',
                                                        'overdue' => 'Vencido',
                                                        'cancelled' => 'Cancelado',
                                                    ])
                                                    ->colors([
                                                        'success' => 'Pago',
                                                        'danger' => 'Vencido',
                                                        'warning' => 'Pendente',
                                                        'gray' => 'Cancelado',
                                                    ])
                                                    ->icons([
                                                        'success' => 'heroicon-o-check-circle',
                                                        'danger' => 'heroicon-o-exclamation-triangle',
                                                        'warning' => 'heroicon-o-clock',
                                                        'gray' => 'heroicon-o-x-circle',
                                                    ])
                                                    ->default('pending')
                                                    ->inline()
                                                    ->grouped()
                                                    ->required()
                                                    ->columnSpan(5),
                                                Select::make('user_id')
                                                    ->label('Responsável')
                                                    ->placeholder('Selecione o responsável')
                                                    ->options(fn () => User::pluck('name', 'id'))
                                                    ->default(fn () => Auth::id())
                                                    ->native(false)
                                                    ->searchable()
                                                    ->required()
                                                    ->columnSpan(3),
                                                Select::make('person_id')
                                                    ->label('Fornecedor')
                                                    ->placeholder('Selecione o fornecedor')
                                                    ->options(fn () => Person::query()->where('people.is_supplier', true)->pluck('name', 'id'))
                                                    ->native(false)
                                                    ->searchable()
                                                    ->preload()
                                                    ->createOptionForm([
                                                        Section::make('Dados do fornecedor')
                                                            ->description('Insira os dados do fornecedor')
                                                            ->collapsible()
                                                            ->schema([
                                                                Hidden::make('is_supplier')->default(true),
                                                                Document::make('document')
                                                                    ->label('CNPJ')
                                                                    ->cnpj()
                                                                    ->columnSpan(1),
                                                                TextInput::make('name')
                                                                    ->label('Razão Social')
                                                                    ->rules([
                                                                        'required',
                                                                        'max:50',
                                                                    ]),
                                                                TextInput::make('surname')
                                                                    ->label('Nome Fantasia')
                                                                    ->rules([
                                                                        'nullable',
                                                                        'max:50',
                                                                    ]),
                                                                DatePicker::make('birth_date')
                                                                    ->label('Data de fundação')
                                                                    ->native(false)
                                                                    ->rules([
                                                                        'nullable',
                                                                        'date',
                                                                        'before:today',
                                                                    ]),
                                                            ])
                                                            ->columnSpanFull()
                                                            ->columns(2)
                                                            ->grow(true),
                                                    ])
                                                    ->createOptionUsing(function (array $data): int {
                                                        return Person::query()->create($data)->getKey();
                                                    })
                                                    ->required()
                                                    ->columnSpan(4),
                                            ]),
                                    ]),
                            ]),
                        Tab::make('values')
                            ->label('Valores e Pagamento')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Section::make('Valores Adicionais')
                                    ->description('Descontos, juros e multas')
                                    ->icon('heroicon-o-banknotes')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                Money::make('discount_amount')
                                                    ->label('Desconto')
                                                    ->default(0.00),
                                                Money::make('interest_amount')
                                                    ->label('Juros')
                                                    ->default(0.00),
                                                Money::make('fine_amount')
                                                    ->label('Multa')
                                                    ->default(0.00),
                                            ]),
                                    ]),

                                Section::make('Valores')
                                    ->description('Informações financeiras e parcelamento')
                                    ->icon('heroicon-o-calculator')
                                    ->schema([
                                        ToggleButtons::make('recurring')
                                            ->label('Recorrente')
                                            ->options([
                                                'yes' => 'Sim',
                                                'no' => 'Não',
                                            ])
                                            ->default('no')
                                            ->inline()
                                            ->grouped()
                                            ->required()
                                            ->columnSpan(3),
                                        Select::make('payment_method')
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
                                            ->searchable()
                                            ->required(),
                                        TextInput::make('reference_number')
                                            ->label('Número de referência')
                                            ->placeholder('Ex: NF-001, Pedido-123')
                                            ->maxLength(50),
                                        TextInput::make('category')
                                            ->label('Categoria')
                                            ->placeholder('Ex: Vendas, Serviços')
                                            ->maxLength(100),

                                        Select::make('parcels')
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
                                                '18' => '18x',
                                                '24' => '24x',
                                            ])
                                            ->default('1')
                                            ->native(false)
                                            ->helperText('Defina a quantidade para gerar as parcelas automaticamente.')
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set, callable $get): void {
                                                $totalCents = (int) round(FormatterHelper::toDecimal($get('amount')) * 100);
                                                $installmentsCount = (int) $state;
                                                if ($installmentsCount < 1) {
                                                    $installmentsCount = 1;
                                                }

                                                $baseCents = intdiv($totalCents, $installmentsCount);
                                                $firstCents = $totalCents - ($baseCents * ($installmentsCount - 1));

                                                $items = [];
                                                for ($i = 0; $i < $installmentsCount; $i++) {
                                                    $items[$i] = [
                                                        'amount' => FormatterHelper::money((($i === 0 ? $firstCents : $baseCents) / 100)),
                                                        'installment_number' => $i + 1,
                                                        'due_date' => $installmentsCount > 1
                                                            ? Carbon::now()->addMonths($i)->format('Y-m-d')
                                                            : Carbon::now()->format('Y-m-d'),
                                                        'status' => 0,
                                                    ];
                                                }

                                                $set('installments', $items);
                                            }),
                                        Money::make('amount')
                                            ->label('Valor Total')
                                            ->default(0.00)
                                            ->required()
                                            ->reactive()
                                            ->helperText('Ao alterar o valor total, as parcelas serão redistribuídas automaticamente.')
                                            ->afterStateUpdated(function ($state, callable $set, callable $get): void {
                                                $set('amount_paid', 0.00);

                                                $installmentsCount = (int) ($get('parcels'));
                                                $totalCents = (int) round(FormatterHelper::toDecimal($state) * 100);
                                                if ($installmentsCount < 1) {
                                                    $installmentsCount = 1;
                                                }

                                                $baseCents = intdiv($totalCents, $installmentsCount);
                                                $firstCents = $totalCents - ($baseCents * ($installmentsCount - 1));

                                                $items = $get('installments') ?? [];

                                                for ($i = 0; $i < $installmentsCount; $i++) {
                                                    $items[$i]['amount'] = FormatterHelper::money((($i === 0 ? $firstCents : $baseCents) / 100));
                                                    // Preserve existing fields if present
                                                    $items[$i]['installment_number'] = $items[$i]['installment_number'] ?? ($i + 1);
                                                    $items[$i]['due_date'] = $items[$i]['due_date'] ?? (
                                                        $installmentsCount > 1
                                                            ? Carbon::now()->addMonths($i)->format('Y-m-d')
                                                            : Carbon::now()->format('Y-m-d')
                                                    );
                                                    $items[$i]['status'] = $items[$i]['status'] ?? 0;
                                                }

                                                $set('installments', $items);
                                            }),
                                        TextInput::make('days_to_pay')
                                            ->label('Dia do vencimento')
                                            ->numeric()
                                            ->default(now()->format('d'))
                                            ->prefixIcon('heroicon-m-calendar')
                                            ->maxValue(31)
                                            ->minValue(1)
                                            ->maxLength(2)
                                            ->required()
                                            ->helperText('Defina o dia do mês para o vencimento das parcelas.')
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set, callable $get): void {
                                                $installmentsCount = (int) ($get('parcels'));
                                                if ($installmentsCount < 1) {
                                                    $installmentsCount = 1;
                                                }
                                                $dayOfMonth = (int) ($state ?? 1);

                                                $items = $get('installments') ?? [];

                                                for ($i = 0; $i < $installmentsCount; $i++) {
                                                    $dueDate = now()
                                                        ->copy()
                                                        ->startOfMonth()
                                                        ->addMonths($i)
                                                        ->day($dayOfMonth)
                                                        ->format('Y-m-d');
                                                    $items[$i]['due_date'] = $dueDate;
                                                    // Preserve other fields if missing
                                                    $items[$i]['amount'] = $items[$i]['amount'] ?? null;
                                                    $items[$i]['installment_number'] = $items[$i]['installment_number'] ?? ($i + 1);
                                                    $items[$i]['status'] = $items[$i]['status'] ?? 0;
                                                }

                                                $set('installments', $items);
                                            }),
                                    ])
                                    ->columns(3),

                                Section::make('Parcelas')
                                    ->description('Detalhamento e ajustes finos das parcelas geradas')
                                    ->icon('heroicon-o-list-bullet')
                                    ->schema([
                                        Repeater::make('installments')
                                            ->relationship('installments')
                                            ->hiddenLabel()
                                            ->default([])
                                            ->compact(true)
                                            ->addable(false)
                                            ->table([
                                                TableColumn::make('Parcela'),
                                                TableColumn::make('Valor'),
                                                TableColumn::make('Vencimento'),
                                                TableColumn::make('Status'),
                                            ])
                                            ->schema([
                                                TextInput::make('installment_number')
                                                    ->label('Parcela')
                                                    ->numeric()
                                                    ->columnSpan(1),
                                                Money::make('amount')
                                                    ->label('Valor')
                                                    ->columnSpan(2),
                                                DatePicker::make('due_date')
                                                    ->label('Vencimento')
                                                    ->columnSpan(2),
                                                Select::make('status')
                                                    ->label('Status')
                                                    ->options([
                                                        0 => 'Pendente',
                                                        1 => 'Recebido',
                                                        2 => 'Vencido',
                                                    ])
                                                    ->native(false)
                                                    ->columnSpan(2),
                                            ]),
                                    ])
                                    ->columnSpanFull(),

                                RichEditor::make('payment_instructions')
                                    ->label('Instruções de Pagamento')
                                    ->placeholder('Ex: PIX: chave@email.com, Conta: 12345-6')
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('attachments')
                            ->label('Anexos')
                            ->icon('heroicon-o-paper-clip')
                            ->schema([
                                Section::make('Documentos')
                                    ->description('Anexe documentos relacionados')
                                    ->icon('heroicon-o-document')
                                    ->schema([
                                        FileUpload::make('attachment')
                                            ->label('Anexo')
                                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                                            ->multiple()
                                            ->maxParallelUploads(3)
                                            ->maxSize(1024 * 5)
                                            ->columnSpanFull()
                                            ->reorderable()
                                            ->appendFiles()
                                            ->openable()
                                            ->downloadable()
                                            ->previewable()
                                            ->deletable(false)
                                            ->uploadingMessage('Carregando arquivo(s)...'),
                                    ]),
                            ]),
                        Tab::make('notes')
                            ->label('Observações')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Informações Adicionais')
                                    ->description('Observações e detalhes extras')
                                    ->icon('heroicon-o-chat-bubble-left-right')
                                    ->schema([
                                        RichEditor::make('notes')
                                            ->label('Descrição')
                                            ->placeholder('Adicione observações sobre esta conta a pagar...')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
