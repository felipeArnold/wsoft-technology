<?php

declare(strict_types=1);

namespace App\Models;

use App\Filament\Components\PtbrMoney;
use App\Helpers\FormatterHelper;
use App\Models\Concerns\Categorizable;
use App\Models\Person\Person;
use App\Observers\ServiceOrderObserver;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
            Section::make('Valores e Garantia')
                ->icon('heroicon-o-currency-dollar')
                ->schema([
                    PtbrMoney::make('labor_value')
                        ->label('Valor da Mão de Obra')
                        ->default(0)
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set, callable $get): void {
                            $labor = FormatterHelper::toDecimal($state);
                            $parts = FormatterHelper::toDecimal($get('parts_value') ?? 0);

                            $set('total_value', FormatterHelper::money($labor + $parts));
                        }),
                    PtbrMoney::make('parts_value')
                        ->label('Valor das Peças')
                        ->default(0)
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set, callable $get): void {
                            $parts = FormatterHelper::toDecimal($state);
                            $labor = FormatterHelper::toDecimal($get('labor_value') ?? 0);

                            $set('total_value', FormatterHelper::money($labor + $parts));
                        })
                        ->columnSpan(1),
                    PtbrMoney::make('total_value')
                        ->label('Valor Total')
                        ->default(0)
                        ->disabled(),
                    TextInput::make('warranty_period')
                        ->label('Período de Garantia')
                        ->placeholder('Ex: 30 dias, 90 dias, 1 ano')
                        ->maxLength(50),
                ])
                ->columns(4)
                ->columnSpanFull(),

            Section::make('Descrição do Serviço')
                ->icon('heroicon-o-document-text')
                ->schema([
                    RichEditor::make('description')
                        ->label('Descrição')
                        ->required()
                        ->columnSpanFull(),
                    RichEditor::make('observations')
                        ->label('Observações')
                        ->columnSpanFull(),
                    RichEditor::make('technical_report')
                        ->label('Relatório Técnico')
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

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
}
