<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People\Schemas;

use App\Models\Person\Person;
use Filament\Schemas\Schema;

final class PersonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components(Person::getForm());
    }
}
