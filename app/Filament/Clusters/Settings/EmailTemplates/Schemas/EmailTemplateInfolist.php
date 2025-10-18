<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\EmailTemplates\Schemas;

use Filament\Schemas\Schema;

final class EmailTemplateInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

            ]);
    }
}
