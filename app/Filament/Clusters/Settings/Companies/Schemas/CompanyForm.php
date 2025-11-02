<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Companies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Leandrocfe\FilamentPtbrFormFields\Document;

final class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Logo da Empresa')
                    ->description('Faça upload do logotipo da sua empresa')
                    ->schema([
                        FileUpload::make('avatar')
                            ->label('Logo')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('tenants/avatars')
                            ->maxSize(2048)
                            ->columnSpanFull()
                            ->helperText('Tamanho máximo: 2MB. Formatos aceitos: JPG, PNG, GIF'),
                    ])
                    ->columns(1),

                Section::make('Informações Básicas')
                    ->description('Dados principais da empresa')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome da Empresa')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Document::make('document')
                            ->label('CNPJ')
                            ->cnpj()
                            ->required()
                            ->columnSpan(1),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpan(1),

                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255)
                            ->columnSpan(1),

                        TextInput::make('type')
                            ->label('Tipo')
                            ->maxLength(255)
                            ->default('company')
                            ->columnSpan(1),
                    ])
                    ->columns(2),
            ]);
    }
}
