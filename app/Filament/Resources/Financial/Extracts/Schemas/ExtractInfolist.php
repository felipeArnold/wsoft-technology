<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Extracts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class ExtractInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
            ]);
    }
}
