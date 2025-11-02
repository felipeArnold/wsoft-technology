<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Companies\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class CompanyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informações da Empresa')
                    ->schema([
                        ImageEntry::make('avatar')
                            ->label('Logo')
                            ->circular()
                            ->columnSpanFull(),

                        TextEntry::make('name')
                            ->label('Nome da Empresa')
                            ->columnSpan(1),

                        TextEntry::make('document')
                            ->label('CNPJ')
                            ->columnSpan(1),

                        TextEntry::make('slug')
                            ->label('Slug')
                            ->columnSpan(1),

                        TextEntry::make('website')
                            ->label('Website')
                            ->openUrlInNewTab()
                            ->columnSpan(1),

                        TextEntry::make('type')
                            ->label('Tipo')
                            ->badge()
                            ->columnSpan(1),

                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i')
                            ->columnSpan(1),
                    ])
                    ->columns(2),
            ]);
    }
}
