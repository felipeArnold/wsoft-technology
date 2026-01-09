<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Sales\Schemas;

use App\Filament\Components\PtbrMoney;
use App\Helpers\FormatterHelper;
use App\Models\Category;
use App\Models\Person\Person;
use App\Models\Product;
use Filament\Facades\Filament;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

final class SaleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('sale_tabs')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('items')
                            ->label('Produtos')
                            ->icon('heroicon-o-shopping-bag')
                            ->schema([
                                Section::make('Cliente')
                                    ->description('Selecione o cliente e responsável pela venda')
                                    ->icon('heroicon-o-user')
                                    ->schema([
                                        Person::getSelectComponent(
                                            label: 'Cliente',
                                            placeholder: 'Selecione o cliente',
                                            columnSpan: 1,
                                            required: true
                                        ),
                                        Select::make('user_id')
                                            ->label('Responsável pela Venda')
                                            ->placeholder('Selecione o responsável')
                                            ->relationship('user', 'name')
                                            ->native(false)
                                            ->searchable()
                                            ->required()
                                            ->helperText('Usuário que receberá a comissão desta venda'),
                                        TextInput::make('sale_number')
                                            ->label('Número da Venda')
                                            ->placeholder('Gerado automaticamente')
                                            ->disabled()
                                            ->dehydrated(),
                                        ToggleButtons::make('status')
                                            ->label('Status')
                                            ->options([
                                                'pending' => 'Pendente',
                                                'completed' => 'Concluída',
                                                'cancelled' => 'Cancelada',
                                            ])
                                            ->colors([
                                                'pending' => 'warning',
                                                'completed' => 'success',
                                                'cancelled' => 'danger',
                                            ])
                                            ->icons([
                                                'pending' => 'heroicon-o-clock',
                                                'completed' => 'heroicon-o-check-circle',
                                                'cancelled' => 'heroicon-o-x-circle',
                                            ])
                                            ->default('pending')
                                            ->inline()
                                            ->grouped(),
                                    ])
                                    ->columns(3),

                                Section::make('Itens da Venda')
                                    ->description('Adicione os produtos para esta venda')
                                    ->icon('heroicon-o-shopping-cart')
                                    ->schema([
                                        Repeater::make('items')
                                            ->relationship()
                                            ->hiddenLabel()
                                            ->compact()
                                            ->table([
                                                TableColumn::make('Produto'),
                                                TableColumn::make('Quantidade'),
                                                TableColumn::make('Preço Unit.'),
                                                TableColumn::make('Desconto'),
                                                TableColumn::make('Total'),
                                            ])
                                            ->schema([
                                                Select::make('product_id')
                                                    ->label('Produto')
                                                    ->placeholder('Selecione o produto')
                                                    ->options(fn () => Product::pluck('name', 'id'))
                                                    ->native(false)
                                                    ->searchable()
                                                    ->required()
                                                    ->live()
                                                    ->afterStateUpdated(function ($state, $set, $get): void {
                                                        if ($state) {
                                                            $product = Product::find($state);
                                                            if ($product) {
                                                                $set('product_name', $product->name);
                                                                $set('unit_price', FormatterHelper::money($product->price_sale));

                                                                // Recalcular total do item
                                                                $quantity = (int) $get('quantity') ?: 1;
                                                                $discount = FormatterHelper::toDecimal($get('discount'));
                                                                $total = ($product->price_sale * $quantity) - $discount;
                                                                $set('total', FormatterHelper::money($total));
                                                            }
                                                        }
                                                    })
                                                    ->columnSpan(4),
                                                Hidden::make('product_name'),
                                                TextInput::make('quantity')
                                                    ->label('Qtd')
                                                    ->numeric()
                                                    ->default(1)
                                                    ->minValue(1)
                                                    ->required()
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(function ($state, $get, $set): void {
                                                        // Recalcular total do item
                                                        $unitPrice = FormatterHelper::toDecimal($get('unit_price'));
                                                        $discount = FormatterHelper::toDecimal($get('discount'));
                                                        $total = ($unitPrice * (int) $state) - $discount;
                                                        $set('total', FormatterHelper::money($total));
                                                    })
                                                    ->columnSpan(2),
                                                PtbrMoney::make('unit_price')
                                                    ->label('Preço Unit.')
                                                    ->default('0,00')
                                                    ->required()
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(function ($state, $get, $set): void {
                                                        // Recalcular total do item
                                                        $unitPrice = FormatterHelper::toDecimal($state);
                                                        $quantity = (int) $get('quantity');
                                                        $discount = FormatterHelper::toDecimal($get('discount'));
                                                        $total = ($unitPrice * $quantity) - $discount;
                                                        $set('total', FormatterHelper::money($total));
                                                    })
                                                    ->columnSpan(2),
                                                PtbrMoney::make('discount')
                                                    ->label('Desconto')
                                                    ->default('0,00')
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(function ($state, $get, $set): void {
                                                        // Recalcular total do item
                                                        $unitPrice = FormatterHelper::toDecimal($get('unit_price'));
                                                        $quantity = (int) $get('quantity');
                                                        $discount = FormatterHelper::toDecimal($state);
                                                        $total = ($unitPrice * $quantity) - $discount;
                                                        $set('total', FormatterHelper::money($total));
                                                    })
                                                    ->columnSpan(2),
                                                PtbrMoney::make('total')
                                                    ->label('Total')
                                                    ->default('0,00')
                                                    ->disabled()
                                                    ->dehydrated()
                                                    ->columnSpan(2),
                                            ])
                                            ->columns(12)
                                            ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                                                $data['tenant_id'] = Filament::getTenant()->id;
                                                $data['unit_price'] = FormatterHelper::toDecimal($data['unit_price']);
                                                $data['discount'] = FormatterHelper::toDecimal($data['discount']);
                                                $data['total'] = FormatterHelper::toDecimal($data['total']);

                                                return $data;
                                            })
                                            ->mutateRelationshipDataBeforeSaveUsing(function (array $data): array {
                                                $data['tenant_id'] = Filament::getTenant()->id;
                                                $data['unit_price'] = FormatterHelper::toDecimal($data['unit_price']);
                                                $data['discount'] = FormatterHelper::toDecimal($data['discount']);
                                                $data['total'] = FormatterHelper::toDecimal($data['total']);

                                                return $data;
                                            })
                                            ->addActionLabel('Adicionar Produto')
                                            ->reorderable()
                                            ->collapsible()
                                            ->cloneable()
                                            ->defaultItems(1)
                                            ->live()
                                            ->afterStateUpdated(function ($get, $set): void {
                                                self::recalculateTotals($get, $set);
                                            })
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Resumo Financeiro')
                                    ->description('Valores calculados automaticamente')
                                    ->icon('heroicon-o-calculator')
                                    ->schema([
                                        PtbrMoney::make('subtotal')
                                            ->label('Subtotal')
                                            ->default('0,00')
                                            ->disabled()
                                            ->dehydrated()
                                            ->live()
                                            ->afterStateHydrated(function ($state, $get, $set): void {
                                                // Recalculate when form loads
                                                self::recalculateTotals($get, $set);
                                            })
                                            ->helperText('Soma de todos os itens da venda'),
                                        PtbrMoney::make('discount_amount')
                                            ->label('Desconto Geral')
                                            ->default('0,00')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, $get, $set): void {
                                                // Recalculate total when discount changes
                                                self::recalculateTotals($get, $set);
                                            })
                                            ->helperText('Desconto adicional sobre o total'),
                                        PtbrMoney::make('total')
                                            ->label('Total da Venda')
                                            ->default('0,00')
                                            ->disabled()
                                            ->dehydrated()
                                            ->live()
                                            ->extraAttributes(['class' => 'font-bold'])
                                            ->helperText('Subtotal - Desconto'),
                                    ])
                                    ->columns(3),

                                Section::make('Etiquetas')
                                    ->description('Classifique esta venda com etiquetas')
                                    ->icon('heroicon-o-tag')
                                    ->schema([
                                        CheckboxList::make('categories')
                                            ->label('Etiquetas')
                                            ->relationship('categories', 'name')
                                            ->options(fn () => Category::query()->pluck('name', 'id'))
                                            ->searchable()
                                            ->bulkToggleable()
                                            ->gridDirection('row')
                                            ->columns(3)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        Tab::make('payment')
                            ->label('Pagamento')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Section::make('Totais')
                                    ->description('Resumo financeiro da venda')
                                    ->icon('heroicon-o-calculator')
                                    ->schema([
                                        PtbrMoney::make('subtotal')
                                            ->label('Subtotal')
                                            ->default('0,00')
                                            ->disabled()
                                            ->dehydrated(),
                                        PtbrMoney::make('discount_amount')
                                            ->label('Desconto Geral')
                                            ->default('0,00')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, $get, $set): void {
                                                $subtotal = FormatterHelper::toDecimal($get('subtotal'));
                                                $discount = FormatterHelper::toDecimal($state);
                                                $total = $subtotal - $discount;
                                                $set('total', FormatterHelper::money($total));
                                            }),
                                        PtbrMoney::make('total')
                                            ->label('Total')
                                            ->default('0,00')
                                            ->disabled()
                                            ->dehydrated(),
                                    ])
                                    ->columns(3),

                                Section::make('Forma de Pagamento')
                                    ->description('Defina como o cliente irá pagar')
                                    ->icon('heroicon-o-credit-card')
                                    ->schema([
                                        Select::make('payment_method')
                                            ->label('Método de Pagamento')
                                            ->options([
                                                'cash' => 'Dinheiro',
                                                'card' => 'Cartão',
                                                'pix' => 'PIX',
                                                'installments' => 'Parcelado',
                                            ])
                                            ->default('cash')
                                            ->native(false)
                                            ->required()
                                            ->reactive(),
                                        Select::make('installments')
                                            ->label('Parcelas')
                                            ->options([
                                                1 => 'À vista',
                                                2 => '2x',
                                                3 => '3x',
                                                4 => '4x',
                                                5 => '5x',
                                                6 => '6x',
                                                7 => '7x',
                                                8 => '8x',
                                                9 => '9x',
                                                10 => '10x',
                                                12 => '12x',
                                            ])
                                            ->default(1)
                                            ->native(false)
                                            ->visible(fn ($get) => $get('payment_method') === 'installments'),
                                        DateTimePicker::make('completed_at')
                                            ->label('Data de Conclusão')
                                            ->placeholder('Será preenchida ao concluir')
                                            ->native(false),
                                    ])
                                    ->columns(3),
                            ]),
                        Tab::make('notes')
                            ->label('Observações')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Observações')
                                    ->description('Informações adicionais sobre a venda')
                                    ->icon('heroicon-o-chat-bubble-left-right')
                                    ->schema([
                                        RichEditor::make('notes')
                                            ->label('Observações')
                                            ->placeholder('Adicione observações sobre esta venda...')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    /**
     * Recalculate sale totals based on items
     */
    private static function recalculateTotals($get, $set): void
    {
        $items = $get('items') ?? [];
        $subtotal = 0;

        // Calculate subtotal from all items
        foreach ($items as $item) {
            if (isset($item['total'])) {
                $subtotal += FormatterHelper::toDecimal($item['total']);
            }
        }

        // Get discount amount
        $discountAmount = FormatterHelper::toDecimal($get('discount_amount') ?? '0,00');

        // Calculate final total
        $total = $subtotal - $discountAmount;

        // Update fields
        $set('subtotal', FormatterHelper::money($subtotal));
        $set('total', FormatterHelper::money($total));
    }
}
