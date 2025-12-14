<?php

declare(strict_types=1);

namespace App\Models;

use App\Filament\Clusters\Settings\Services\ServiceResource;
use App\Filament\Components\PtbrMoney;
use App\Helpers\FormatterHelper;
use App\Models\Accounts\Accounts;
use App\Models\Concerns\Categorizable;
use App\Models\Person\Person;
use App\Observers\ServiceOrderObserver;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(ServiceOrderObserver::class)]
final class ServiceOrder extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceOrderFactory> */
    use Categorizable;

    use HasFactory;

    protected $casts = [
        'opening_date' => 'date',
        'expected_completion_date' => 'date',
        'completion_date' => 'date',
        'total_value' => 'float',
        'labor_value' => 'float',
        'parts_value' => 'float',
        'attachments' => 'array',
    ];

    public static function getForm(): array
    {
        return [
            Tabs::make('service_order_tabs')
                ->columnSpanFull()
                ->tabs([
                    Tab::make('basic_info')
                        ->label('Informações Básicas')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->schema([
                            Section::make('Informações da Ordem de Serviço')
                                ->icon('heroicon-o-clipboard-document-list')
                                ->schema([
                                    TextInput::make('number')
                                        ->label('Número')
                                        ->placeholder(fn (string $context) => $context === 'create' ? 'Será gerado automaticamente' : '')
                                        ->disabled()
                                        ->maxLength(50)
                                        ->columnSpan(1),
                                    Select::make('status')
                                        ->label('Status')
                                        ->options([
                                            'draft' => 'Rascunho',
                                            'in_progress' => 'Em Andamento',
                                            'completed' => 'Concluída',
                                            'cancelled' => 'Cancelada',
                                        ])
                                        ->default('draft')
                                        ->required()
                                        ->native(false)
                                        ->columnSpan(1),
                                    Select::make('priority')
                                        ->label('Prioridade')
                                        ->options([
                                            'low' => 'Baixa',
                                            'medium' => 'Média',
                                            'high' => 'Alta',
                                            'urgent' => 'Urgente',
                                        ])
                                        ->default('medium')
                                        ->required()
                                        ->native(false)
                                        ->columnSpan(1),
                                    DatePicker::make('opening_date')
                                        ->label('Data de Abertura')
                                        ->required()
                                        ->native()
                                        ->default(now())
                                        ->native(false)
                                        ->columnSpan(1),
                                    DatePicker::make('expected_completion_date')
                                        ->label('Data Prevista de Conclusão')
                                        ->native(false)
                                        ->columnSpan(1),
                                    DatePicker::make('completion_date')
                                        ->label('Data de Conclusão')
                                        ->native(false)
                                        ->columnSpan(1),
                                ])
                                ->columns(3)
                                ->columnSpanFull(),

                            Section::make('Cliente e Responsável')
                                ->icon('heroicon-o-users')
                                ->schema([
                                    Select::make('person_id')
                                        ->label('Cliente')
                                        ->relationship('person', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->createOptionForm(fn (Schema $schema) => $schema->components([
                                            ...Person::getForm(),
                                        ]))
                                        ->columnSpan(1),
                                    Select::make('user_id')
                                        ->label('Responsável Técnico')
                                        ->relationship('user', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->columnSpan(1),
                                ])
                                ->columns(2)
                                ->columnSpanFull(),
                        ]),

                    Tab::make('items')
                        ->label('Serviços e Produtos')
                        ->icon('heroicon-o-shopping-cart')
                        ->schema([
                            self::getServicesSection(),
                            self::getProductsSection(),
                            self::getValuesSection(),
                        ]),

                    Tab::make('attachments_tags')
                        ->label('Informações Adicionais')
                        ->icon('heroicon-o-tag')
                        ->schema([
                            Section::make('Anexos')
                                ->icon('heroicon-o-paper-clip')
                                ->description('Documentos e imagens relacionados')
                                ->schema([
                                    FileUpload::make('attachments')
                                        ->label('Anexos')
                                        ->acceptedFileTypes(['image/*', 'application/pdf'])
                                        ->multiple()
                                        ->maxSize(1024 * 5)
                                        ->columnSpanFull(),
                                ])
                                ->columnSpanFull(),

                            Section::make('Etiquetas')
                                ->icon('heroicon-o-tag')
                                ->description('Classifique esta ordem de serviço com etiquetas')
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
                                ])
                                ->columnSpanFull(),

                            Section::make('Descrição do Serviço')
                                ->icon('heroicon-o-document-text')
                                ->schema([
                                    RichEditor::make('description')
                                        ->label('Descrição')
                                        ->columnSpanFull(),
                                    RichEditor::make('observations')
                                        ->label('Observações')
                                        ->columnSpanFull(),
                                    RichEditor::make('technical_report')
                                        ->label('Relatório Técnico')
                                        ->columnSpanFull(),
                                ])
                                ->columnSpanFull(),
                        ]),
                ]),
        ];
    }

    public static function getTableColumns(): array
    {
        return [
            TextColumn::make('number')
                ->label('Número')
                ->searchable()
                ->sortable(),
            TextColumn::make('person.name')
                ->label('Cliente')
                ->searchable()
                ->sortable(),
            TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'draft' => 'gray',
                    'in_progress' => 'warning',
                    'completed' => 'success',
                    'cancelled' => 'danger',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'draft' => 'Rascunho',
                    'in_progress' => 'Em Andamento',
                    'completed' => 'Concluída',
                    'cancelled' => 'Cancelada',
                }),
            TextColumn::make('priority')
                ->label('Prioridade')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'low' => 'gray',
                    'medium' => 'info',
                    'high' => 'warning',
                    'urgent' => 'danger',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'low' => 'Baixa',
                    'medium' => 'Média',
                    'high' => 'Alta',
                    'urgent' => 'Urgente',
                }),
            TextColumn::make('opening_date')
                ->label('Data de Abertura')
                ->date('d/m/Y')
                ->sortable(),
            TextColumn::make('expected_completion_date')
                ->label('Data Prevista')
                ->date('d/m/Y')
                ->sortable(),
            TextColumn::make('total_value')
                ->label('Valor Total')
                ->money('BRL')
                ->sortable(),
            TextColumn::make('user.name')
                ->label('Responsável')
                ->searchable(),
            TextColumn::make('categories.name')
                ->label('Etiquetas')
                ->badge()
                ->separator(',')
                ->searchable()
                ->toggleable(),
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function serviceOrderServices(): HasMany
    {
        return $this->hasMany(ServiceOrderService::class);
    }

    public function serviceOrderProducts(): HasMany
    {
        return $this->hasMany(ServiceOrderProduct::class);
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Accounts::class);
    }

    private static function getServicesSection(): Section
    {
        return Section::make('Serviços')
            ->description('Adicione os serviços prestados nesta ordem')
           ->afterHeader([
               Action::make('settings')
                   ->label('Configurações de Serviços')
                   ->color('default')
                   ->outlined()
                   ->icon('heroicon-o-cog-6-tooth')
                   ->url(ServiceResource::getUrl('index'))
                   ->openUrlInNewTab(true)
                   ->tooltip('Gerenciar Serviços'),
            ])
                ->icon('heroicon-o-wrench-screwdriver')
                ->schema([
                    Repeater::make('serviceOrderServices')
                        ->relationship()
                        ->hiddenLabel()
                        ->compact()
                        ->hiddenLabel()
                        ->default([])
                        ->compact(true)
                        ->table([
                            TableColumn::make('Serviço'),
                            TableColumn::make('Qtd'),
                            TableColumn::make('Preço Unit.'),
                            TableColumn::make('Desconto'),
                            TableColumn::make('Total'),
                        ])
                        ->schema([
                            Select::make('service_id')
                                ->label('Serviço')
                                ->placeholder('Selecione o serviço')
                                ->options(fn () => Service::pluck('name', 'id'))
                                ->native(false)
                                ->searchable()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, $set): void {
                                    if ($state) {
                                        $service = Service::query()->find($state);
                                        if ($service) {
                                            $set('service_name', $service->name);
                                            $set('unit_price', FormatterHelper::money($service->price));
                                            $discount = FormatterHelper::toDecimal($service->discount);
                                            $total = $service->price - $discount;
                                            $set('discount', FormatterHelper::money($discount));
                                            $set('total', FormatterHelper::money($total));
                                        }
                                    }
                                })
                                ->columnSpan(4),
                            Hidden::make('service_name'),
                            TextInput::make('quantity')
                                ->label('Qtd')
                                ->numeric()
                                ->default(1)
                                ->minValue(1)
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function ($state, $get, $set): void {
                                    $unitPrice = FormatterHelper::toDecimal($get('unit_price'));
                                    $discount = FormatterHelper::toDecimal($get('discount'));
                                    $total = ($unitPrice * (int) $state) - $discount;
                                    $set('total', FormatterHelper::money($total));
                                    self::recalculateTotals($get, $set);
                                })
                                ->columnSpan(2),
                            PtbrMoney::make('unit_price')
                                ->label('Preço Unit.')
                                ->default('0,00')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function ($state, $get, $set): void {
                                    $unitPrice = FormatterHelper::toDecimal($state);
                                    $quantity = (int) $get('quantity');
                                    $discount = FormatterHelper::toDecimal($get('discount'));
                                    $total = ($unitPrice * $quantity) - $discount;
                                    $set('total', FormatterHelper::money($total));
                                    self::recalculateTotals($get, $set);
                                })
                                ->columnSpan(2),
                            PtbrMoney::make('discount')
                                ->label('Desconto')
                                ->default('0,00')
                                ->live(onBlur: true)
                                ->afterStateUpdated(function ($state, $get, $set): void {
                                    $unitPrice = FormatterHelper::toDecimal($get('unit_price'));
                                    $quantity = (int) $get('quantity');
                                    $discount = FormatterHelper::toDecimal($state);
                                    $total = ($unitPrice * $quantity) - $discount;
                                    $set('total', FormatterHelper::money($total));
                                    self::recalculateTotals($get, $set);
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
                        ->addActionLabel('Adicionar Serviço')
                        ->reorderable()
                        ->collapsible()
                        ->cloneable()
                        ->defaultItems(0)
                        ->live()
                        ->afterStateUpdated(function ($get, $set): void {
                            self::recalculateTotals($get, $set);
                        })
                        ->columnSpanFull(),
                ]);
    }

    private static function getProductsSection(): Section
    {
        return Section::make('Produtos/Peças')
            ->description('Adicione os produtos e peças utilizados nesta ordem')
            ->icon('heroicon-o-cube')
            ->schema([
                Repeater::make('serviceOrderProducts')
                    ->relationship()
                    ->hiddenLabel()
                    ->compact(true)
                    ->table([
                        TableColumn::make('Produto'),
                        TableColumn::make('Qtd'),
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
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set): void {
                                if ($state) {
                                    $product = Product::find($state);
                                    if ($product) {
                                        $set('product_name', $product->name);
                                        $set('unit_price', FormatterHelper::money($product->price_sale));
                                        $total = $product->price_sale;
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
                                $unitPrice = FormatterHelper::toDecimal($get('unit_price'));
                                $discount = FormatterHelper::toDecimal($get('discount'));
                                $total = ($unitPrice * (int) $state) - $discount;
                                $set('total', FormatterHelper::money($total));
                                self::recalculateTotals($get, $set);
                            })
                            ->columnSpan(2),
                        PtbrMoney::make('unit_price')
                            ->label('Preço Unit.')
                            ->default('0,00')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $get, $set): void {
                                $unitPrice = FormatterHelper::toDecimal($state);
                                $quantity = (int) $get('quantity');
                                $discount = FormatterHelper::toDecimal($get('discount'));
                                $total = ($unitPrice * $quantity) - $discount;
                                $set('total', FormatterHelper::money($total));
                                self::recalculateTotals($get, $set);
                            })
                            ->columnSpan(2),
                        PtbrMoney::make('discount')
                            ->label('Desconto')
                            ->default('0,00')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $get, $set): void {
                                $unitPrice = FormatterHelper::toDecimal($get('unit_price'));
                                $quantity = (int) $get('quantity');
                                $discount = FormatterHelper::toDecimal($state);
                                $total = ($unitPrice * $quantity) - $discount;
                                $set('total', FormatterHelper::money($total));
                                self::recalculateTotals($get, $set);
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
                    ->defaultItems(0)
                    ->live()
                    ->afterStateUpdated(function ($get, $set): void {
                        self::recalculateTotals($get, $set);
                    })
                    ->columnSpanFull(),
            ]);
    }

    private static function getValuesSection(): Section
    {
        return Section::make('Resumo Financeiro')
            ->description('Valores calculados automaticamente com base nos itens')
            ->icon('heroicon-o-calculator')
            ->schema([
                PtbrMoney::make('labor_value')
                    ->label('Valor da Mão de Obra (Serviços)')
                    ->default('0,00')
                    ->disabled()
                    ->dehydrated()
                    ->helperText('Calculado automaticamente com base nos serviços'),
                PtbrMoney::make('parts_value')
                    ->label('Valor das Peças (Produtos)')
                    ->default('0,00')
                    ->disabled()
                    ->dehydrated()
                    ->helperText('Calculado automaticamente com base nos produtos'),
                PtbrMoney::make('total_value')
                    ->label('Valor Total')
                    ->default('0,00')
                    ->disabled()
                    ->dehydrated(),
                TextInput::make('warranty_period')
                    ->label('Período de Garantia')
                    ->placeholder('Ex: 30 dias, 90 dias, 1 ano')
                    ->maxLength(50),
            ])
            ->columns(4);
    }

    private static function recalculateTotals($get, $set): void
    {
        // Calcular labor_value (serviços)
        $services = $get('serviceOrderServices') ?? [];
        $laborValue = 0;
        foreach ($services as $service) {
            if (isset($service['total'])) {
                $laborValue += FormatterHelper::toDecimal($service['total']);
            }
        }

        // Calcular parts_value (produtos)
        $products = $get('serviceOrderProducts') ?? [];
        $partsValue = 0;
        foreach ($products as $product) {
            if (isset($product['total'])) {
                $partsValue += FormatterHelper::toDecimal($product['total']);
            }
        }

        // Atualizar totais
        $set('labor_value', FormatterHelper::money($laborValue));
        $set('parts_value', FormatterHelper::money($partsValue));
        $set('total_value', FormatterHelper::money($laborValue + $partsValue));
    }
}
