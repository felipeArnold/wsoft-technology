<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do usuário')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->rules(['required']),
                        TextInput::make('email')
                            ->label('E-mail')
                            ->rules(['required', 'email']),
                        TextInput::make('password')
                            ->label('Senha')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(fn (?string $state) => filled($state)),
                        TextInput::make('password_confirmation')
                            ->label('Confirme a senha')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(fn (?string $state) => filled($state)),
                        TextInput::make('commission_percentage')
                            ->label('Percentual de Comissão (%)')
                            ->numeric()
                            ->suffix('%')
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(0.01)
                            ->default(0)
                            ->helperText('Percentual de comissão sobre serviços prestados'),
                        FileUpload::make('avatar')
                            ->label('Avatar')
                            ->image()
                            ->imageEditor()
                            ->directory('users/avatars')
                            ->visibility('public')
                            ->maxSize(1024)
                            ->helperText('Tamanho máximo: 1MB'),

                    ])->columns()
                    ->columnSpanFull(),
            ]);
    }
}
