<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Companies\Schemas;

use App\Enum\TenantType;
use App\Models\Person\Addresses;
use App\Models\Person\Emails;
use App\Models\Person\Phones;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Leandrocfe\FilamentPtbrFormFields\Document;

final class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Dados da Empresa')
                    ->tabs([
                        Tab::make('Dados Gerais')
                            ->icon('heroicon-o-building-office-2')
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
                                    ->columnSpan(1),

                                TextInput::make('website')
                                    ->label('Website')
                                    ->url()
                                    ->prefixIcon('heroicon-o-globe-alt')
                                    ->maxLength(255)
                                    ->placeholder('https://www.exemplo.com.br')
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
                            ->columns(2),

                        Tab::make('Contatos')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Flex::make([
                                    Section::make('Telefones')
                                        ->description('Telefones para contato')
                                        ->icon('heroicon-o-phone')
                                        ->schema([Phones::getForm()])
                                        ->columnSpanFull(),

                                    Section::make('E-mails')
                                        ->description('E-mails para contato')
                                        ->icon('heroicon-o-envelope')
                                        ->schema([Emails::getForm()])
                                        ->columnSpanFull(),
                                ])->from('md')->columns(2)->columnSpanFull(),
                            ]),

                        Tab::make('Endereços')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                ...Addresses::getForm(),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }
}
