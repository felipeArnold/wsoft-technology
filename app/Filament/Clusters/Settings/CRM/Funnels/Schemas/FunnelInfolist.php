<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Funnels\Schemas;

use Filament\Infolists\Components\ColorEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class FunnelInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Funil')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nome'),
                        TextEntry::make('description')
                            ->label('Descrição')
                            ->placeholder('Sem descrição'),
                        ColorEntry::make('color')
                            ->label('Cor'),
                        IconEntry::make('active')
                            ->label('Status')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger'),
                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i'),
                        TextEntry::make('updated_at')
                            ->label('Atualizado em')
                            ->dateTime('d/m/Y H:i'),
                    ])
                    ->columns(2),

                Section::make('Etapas do Funil')
                    ->schema([
                        RepeatableEntry::make('stages')
                            ->label('Etapas')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nome'),
                                TextEntry::make('description')
                                    ->label('Descrição')
                                    ->placeholder('Sem descrição'),
                                ColorEntry::make('color')
                                    ->label('Cor'),
                                IconEntry::make('active')
                                    ->label('Ativa')
                                    ->boolean(),
                            ])
                            ->columns(2)
                            ->placeholder('Nenhuma etapa cadastrada'),
                    ]),
            ]);
    }
}
