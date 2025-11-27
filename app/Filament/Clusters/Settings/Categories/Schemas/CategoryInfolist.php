<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Categories\Schemas;

use Filament\Infolists\Components\ColorEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')->label('Nome'),
                ColorEntry::make('color')->label('Color'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),

            ]);
    }
}
