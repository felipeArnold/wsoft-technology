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

            ]);
    }
}
