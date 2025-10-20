<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Products\Schemas;

use App\Filament\Components\PtbrMoney;
use App\Helpers\FormatterHelper;
use App\Models\Person\Person;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
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
                        TextInput::make('sku')
                            ->label('Código SKU')
                            ->placeholder('Código SKU')
                            ->maxLength(50)
                            ->columnSpan(1),

                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make('Preços e Margem')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        PtbrMoney::make('price_cost')
                            ->label('Valor de Custo')
                            ->default(0)
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get): void {
                                $labor = FormatterHelper::toDecimal($state);
                                $parts = FormatterHelper::toDecimal($get('price_sale') ?? 0);

                                $set('net_profit', FormatterHelper::money($parts - $labor));
                            })
                            ->columnSpan(1),
                        PtbrMoney::make('price_sale')
                            ->label('Valor de Venda')
                            ->default(0)
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get): void {
                                $parts = FormatterHelper::toDecimal($state);
                                $labor = FormatterHelper::toDecimal($get('price_cost') ?? 0);

                                $set('net_profit', FormatterHelper::money($parts - $labor));
                            })
                            ->columnSpan(1),
                        PtbrMoney::make('net_profit')
                            ->label('Lucro Líquido')
                            ->default(0)
                            ->disabled()
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
                            ->label('Alerta de Estoque')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required()
                            ->helperText('Quantidade mínima para alerta de estoque baixo')
                            ->columnSpan(1),
                        RichEditor::make('description')
                            ->label('Descrição')
                            ->columnSpanFull(),
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
