<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Products\Schemas;

use Filament\Schemas\Schema;

final class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }
}
