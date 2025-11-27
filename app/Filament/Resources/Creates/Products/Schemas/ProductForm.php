<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Products\Schemas;

use App\Filament\Components\PtbrMoney;
use App\Helpers\FormatterHelper;
use App\Models\Category;
use App\Models\Person\Person;
use Filament\Facades\Filament;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Produto')
                    ->icon('heroicon-o-cube')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome do Produto')
                            ->required()
                            ->placeholder('Nome do produto')
                            ->maxLength(255)
                            ->columnSpan(2),
                        Select::make('category_id')
                            ->label('Categoria')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nome da Categoria')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('description')
                                    ->label('Descrição')
                                    ->maxLength(500),
                                ColorPicker::make('color')
                                    ->label('Cor'),
                            ])
                            ->createOptionUsing(function (array $data): int {
                                $category = Category::create([
                                    'tenant_id' => Filament::getTenant()->id,
                                    'name' => $data['name'],
                                    'description' => $data['description'] ?? null,
                                    'color' => $data['color'] ?? null,
                                ]);

                                return $category->id;
                            })
                            ->columnSpan(1),
                        TextInput::make('sku')
                            ->label('Código SKU')
                            ->placeholder('Código SKU')
                            ->maxLength(50)
                            ->columnSpan(1),
                        TextInput::make('barcode')
                            ->label('Código de Barras')
                            ->placeholder('Código de barras (EAN, UPC, etc.)')
                            ->maxLength(255)
                            ->columnSpan(1),
                        RichEditor::make('description')
                            ->label('Descrição')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make('Precificação')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        PtbrMoney::make('price_cost')
                            ->label('Valor de Custo')
                            ->default(0)
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get): void {
                                $cost = FormatterHelper::toDecimal($state);
                                $sale = FormatterHelper::toDecimal($get('price_sale') ?? 0);

                                $profit = $sale - $cost;
                                $set('net_profit', FormatterHelper::money($profit));

                                // Calcula margem de lucro em %
                                if ($sale > 0) {
                                    $margin = ($profit / $sale) * 100;
                                    $set('profit_margin', number_format($margin, 2, '.', ''));
                                }
                            })
                            ->columnSpan(1),
                        PtbrMoney::make('average_cost')
                            ->label('Custo Médio')
                            ->default(0)
                            ->disabled()
                            ->helperText('Calculado automaticamente com base nas movimentações de estoque')
                            ->columnSpan(1),
                        PtbrMoney::make('price_sale')
                            ->label('Valor de Venda')
                            ->default(0)
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get): void {
                                $sale = FormatterHelper::toDecimal($state);
                                $cost = FormatterHelper::toDecimal($get('price_cost') ?? 0);

                                $profit = $sale - $cost;
                                $set('net_profit', FormatterHelper::money($profit));

                                // Calcula margem de lucro em %
                                if ($sale > 0) {
                                    $margin = ($profit / $sale) * 100;
                                    $set('profit_margin', number_format($margin, 2, '.', ''));
                                }
                            })
                            ->columnSpan(1),
                        PtbrMoney::make('net_profit')
                            ->label('Lucro Líquido')
                            ->default(0)
                            ->disabled()
                            ->columnSpan(1),
                        TextInput::make('profit_margin')
                            ->label('Margem de Lucro (%)')
                            ->numeric()
                            ->disabled()
                            ->suffix('%')
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make('Fornecedor e Estoque')
                    ->icon('heroicon-o-building-storefront')
                    ->schema([
                        Select::make('person_id')
                            ->label('Fornecedor')
                            ->relationship('person', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nome do Fornecedor')
                                    ->required(),
                                TextInput::make('cpf_cnpj')
                                    ->label('CPF/CNPJ')
                                    ->required(),
                                TextInput::make('mobile_phone')
                                    ->label('Telefone'),
                                TextInput::make('email')
                                    ->label('E-mail')
                                    ->email(),
                            ])
                            ->createOptionUsing(function (array $data): int {
                                $supplier = Person::create([
                                    'client_or_supplier' => 'supplier',
                                    'name' => $data['name'],
                                    'cpf_cnpj' => $data['cpf_cnpj'],
                                    'mobile_phone' => $data['mobile_phone'] ?? null,
                                    'email' => $data['email'] ?? null,
                                    'type' => 'PF',
                                    'tenant_id' => Filament::getTenant()->id,
                                ]);

                                return $supplier->id;
                            })
                            ->columnSpan(1),
                        TextInput::make('stock')
                            ->label('Estoque Atual')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('stock_alert')
                            ->label('Alerta de Estoque Mínimo')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required()
                            ->helperText('Quantidade mínima para alerta de estoque baixo')
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make('Anexos')
                    ->icon('heroicon-o-paper-clip')
                    ->schema([
                        FileUpload::make('attachment')
                            ->label('Anexos')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->multiple()
                            ->maxSize(1024 * 5)
                            ->helperText('Formatos aceitos: JPG, PNG, PDF (máximo 5MB)')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
