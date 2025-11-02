<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Companies\Schemas;

use Filament\Schemas\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Schema;
use Leandrocfe\FilamentPtbrFormFields\Document;

final class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informações Básicas')
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

                        FileUpload::make('avatar')
                            ->label('Logo')
                            ->image()
                            ->imageEditor()
                            ->directory('tenants/avatars')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
