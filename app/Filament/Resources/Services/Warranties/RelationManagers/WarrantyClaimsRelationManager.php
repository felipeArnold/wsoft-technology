<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Warranties\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class WarrantyClaimsRelationManager extends RelationManager
{
    protected static string $relationship = 'warrantyClaims';

    protected static ?string $title = 'Acionamentos de Garantia';

    protected static ?string $label = 'Acionamento';

    protected static ?string $pluralLabel = 'Acionamentos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Acionamento')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->schema([
                        TextInput::make('claim_number')
                            ->label('Número do Acionamento')
                            ->default(fn () => 'AC-' . now()->format('Ymd') . '-' . str_pad((string) rand(1, 9999), 4, '0', STR_PAD_LEFT))
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->columnSpan(1),

                        DatePicker::make('claim_date')
                            ->label('Data do Acionamento')
                            ->required()
                            ->default(now())
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

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pendente',
                                'approved' => 'Aprovado',
                                'rejected' => 'Rejeitado',
                                'in_progress' => 'Em Andamento',
                                'completed' => 'Concluído',
                            ])
                            ->default('pending')
                            ->required()
                            ->native(false)
                            ->reactive()
                            ->columnSpan(1),

                        Select::make('assigned_technician_id')
                            ->label('Técnico Responsável')
                            ->relationship('assignedTechnician', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),

                        TextInput::make('defect_type')
                            ->label('Tipo de Defeito')
                            ->placeholder('Ex: Elétrico, Mecânico, Software...')
                            ->maxLength(255)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Descrição do Problema')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        RichEditor::make('issue_description')
                            ->label('Descrição do Problema')
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('rejection_reason')
                            ->label('Motivo da Rejeição')
                            ->visible(fn ($get) => $get('status') === 'rejected')
                            ->columnSpanFull(),

                        RichEditor::make('resolution_description')
                            ->label('Descrição da Resolução')
                            ->visible(fn ($get) => in_array($get('status'), ['in_progress', 'completed']))
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Section::make('Custos')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        Toggle::make('covered_by_warranty')
                            ->label('Coberto pela Garantia?')
                            ->default(true)
                            ->inline(false)
                            ->columnSpanFull(),

                        TextInput::make('labor_cost')
                            ->label('Custo de Mão de Obra')
                            ->numeric()
                            ->prefix('R$')
                            ->default(0)
                            ->columnSpan(1),

                        TextInput::make('parts_cost')
                            ->label('Custo de Peças')
                            ->numeric()
                            ->prefix('R$')
                            ->default(0)
                            ->columnSpan(1),

                        TextInput::make('additional_cost')
                            ->label('Custos Adicionais')
                            ->numeric()
                            ->prefix('R$')
                            ->default(0)
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->collapsed(),

                Section::make('Datas de Controle')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        DatePicker::make('approved_at')
                            ->label('Data de Aprovação')
                            ->native(false)
                            ->columnSpan(1),

                        DatePicker::make('started_at')
                            ->label('Data de Início')
                            ->native(false)
                            ->columnSpan(1),

                        DatePicker::make('resolved_at')
                            ->label('Data de Resolução')
                            ->native(false)
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->collapsed(),

                Section::make('Resolução e Feedback')
                    ->icon('heroicon-o-star')
                    ->schema([
                        Select::make('resolution_service_order_id')
                            ->label('OS de Resolução')
                            ->relationship('resolutionServiceOrder', 'number')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),

                        Textarea::make('customer_feedback')
                            ->label('Feedback do Cliente')
                            ->rows(3)
                            ->columnSpan(1),

                        Select::make('customer_rating')
                            ->label('Avaliação do Cliente')
                            ->options([
                                1 => '⭐ (1 - Muito Insatisfeito)',
                                2 => '⭐⭐ (2 - Insatisfeito)',
                                3 => '⭐⭐⭐ (3 - Neutro)',
                                4 => '⭐⭐⭐⭐ (4 - Satisfeito)',
                                5 => '⭐⭐⭐⭐⭐ (5 - Muito Satisfeito)',
                            ])
                            ->native(false)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsed(),

                Section::make('Anexos e Observações')
                    ->icon('heroicon-o-paper-clip')
                    ->schema([
                        FileUpload::make('attachments')
                            ->label('Anexos')
                            ->multiple()
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->maxSize(5120)
                            ->columnSpanFull(),

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->collapsed(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('claim_number')
                    ->label('Nº Acionamento')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Número copiado!')
                    ->weight('bold'),

                TextColumn::make('claim_date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'approved' => 'info',
                        'rejected' => 'danger',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'approved' => 'Aprovado',
                        'rejected' => 'Rejeitado',
                        'in_progress' => 'Em Andamento',
                        'completed' => 'Concluído',
                        default => $state,
                    }),

                TextColumn::make('priority')
                    ->label('Prioridade')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'low' => 'gray',
                        'medium' => 'info',
                        'high' => 'warning',
                        'urgent' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'low' => 'Baixa',
                        'medium' => 'Média',
                        'high' => 'Alta',
                        'urgent' => 'Urgente',
                        default => $state,
                    }),

                TextColumn::make('assignedTechnician.name')
                    ->label('Técnico')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('defect_type')
                    ->label('Tipo de Defeito')
                    ->toggleable(),

                TextColumn::make('covered_by_warranty')
                    ->label('Coberto?')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Sim' : 'Não')
                    ->toggleable(),

                TextColumn::make('customer_rating')
                    ->label('Avaliação')
                    ->formatStateUsing(fn (?int $state): string => $state ? str_repeat('⭐', $state) : '-')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('claim_date', 'desc')
            ->headerActions([
                CreateAction::make()
                    ->label('Novo Acionamento')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['tenant_id'] = \Filament\Facades\Filament::getTenant()->id;
                        $data['user_id'] = auth()->id();

                        return $data;
                    }),
            ]);
    }
}
