<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Users\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Usuário')
                    ->icon('heroicon-o-user')
                    ->description('Informações básicas do usuário cadastrado no sistema')
                    ->schema([
                        ImageEntry::make('avatar')
                            ->circular()
                            ->label('Avatar')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('name')
                            ->label('Nome')
                            ->placeholder('-'),
                        TextEntry::make('email')
                            ->label('E-mail')
                            ->placeholder('-'),
                        TextEntry::make('commission_percentage')
                            ->label('Percentual de Comissão')
                            ->formatStateUsing(fn ($state) => $state ? number_format($state, 2, ',', '.').'%' : 'Não configurado')
                            ->placeholder('-'),
                        TextEntry::make('email_verified_at')
                            ->label('E-mail verificado em')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Atualizado em')
                            ->dateTime()
                            ->placeholder('-'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
