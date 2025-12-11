<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Companies\Schemas;

use App\Enums\TenantType;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
                Section::make('Informações Básicas')
                    ->description('Dados principais da empresa')
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

                        TextInput::make('name')
                            ->label('Nome da Empresa')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),

                        Document::make('document')
                            ->label('CNPJ')
                            ->cnpj()
                            ->required()
                            ->columnSpan(1),

                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255)
                            ->columnSpan(1),

                        Select::make('type')
                            ->label('Tipo de Empresa')
                            ->options(TenantType::toSelectArray())
                            ->default(TenantType::OTHER->value)
                            ->required()
                            ->searchable()
                            ->helperText('Selecione o tipo de negócio da sua empresa')
                            ->columnSpan(1),
                    ])
                    ->columnSpanFull()
                    ->columns(2),
            ]);
    }
}
