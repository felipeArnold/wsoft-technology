<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\DigitalSignature\Envelopes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\PtbrPhone;

final class EnvelopeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Envelope')
                ->tabs([
                    Tab::make('Informações Básicas')
                        ->icon('heroicon-o-envelope')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Nome do Envelope')
                                        ->required()
                                        ->maxLength(255)
                                        ->columnSpan(2),
                                    DatePicker::make('deadline')
                                        ->label('Prazo para Assinatura')
                                        ->native()
                                        ->minDate(now()->toDateString())
                                        ->maxDate(now()->addDays(30)->toDateString())
                                        ->default(now()->addDays(30))
                                        ->required()
                                        ->columnSpan(1),
                                    Select::make('status')
                                        ->label('Status')
                                        // if form create set disabled to false
                                        ->disabled(fn (string $context): bool => $context !== 'edit')
                                        ->options([
                                            'draft' => 'Rascunho',
                                            'sent' => 'Enviado',
                                            'signed' => 'Assinado',
                                            'expired' => 'Expirado',
                                            'cancelled' => 'Cancelado',
                                        ])
                                        ->default('draft')
                                        ->required()
                                        ->native(false)
                                        ->columnSpan(1),
                                    FileUpload::make('documents')
                                        ->label('Documentos')
                                        ->acceptedFileTypes(['application/pdf'])
                                        ->multiple()
                                        ->maxSize(1024 * 10)
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    Tab::make('Signatários')
                        ->icon('heroicon-o-users')
                        ->schema([
                            Repeater::make('signers')
                                ->label('Signatários')
                                ->relationship('signers')
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('name')
                                                ->label('Nome Completo')
                                                ->required()
                                                ->maxLength(255)
                                                ->columnSpan(1),
                                            Document::make('document_number')
                                                ->label('CPF/CNPJ')
                                                ->dynamic()
                                                ->required()
                                                ->maxLength(20)
                                                ->columnSpan(1),
                                            TextInput::make('email')
                                                ->label('E-mail')
                                                ->email()
                                                ->required()
                                                ->maxLength(255)
                                                ->columnSpan(1),
                                            PtbrPhone::make('phone')
                                                ->label('Telefone')
                                                ->tel()
                                                ->maxLength(20)
                                                ->columnSpan(1),
                                            DatePicker::make('birth_date')
                                                ->label('Data de Nascimento')
                                                ->native(true)
                                                ->maxDate(now()->subDay())
                                                ->required()
                                                ->columnSpan(1),
                                            Select::make('signer_type')
                                                ->label('Tipo de Signatário')
                                                ->options([
                                                    'signer' => 'Signatário',
                                                    'witness' => 'Testemunha',
                                                    'approver' => 'Aprovador',
                                                ])
                                                ->required()
                                                ->native(false)
                                                ->columnSpan(1),
                                            Toggle::make('signature_with_photo')
                                                ->label('Assinatura com Foto')
                                                ->default(false)
                                                ->columnSpan(2),
                                            Toggle::make('document_front_back')
                                                ->label('Documento Frente e Verso')
                                                ->default(false)
                                                ->columnSpan(2),
                                            Toggle::make('rubric')
                                                ->label('Rubrica em Todas as Páginas')
                                                ->default(false)
                                                ->columnSpan(2),
                                        ]),
                                ])
                                ->columns(1)
                                ->addActionLabel('Adicionar Signatário')
                                ->collapsible()
                                ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                                ->columnSpanFull(),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }
}
