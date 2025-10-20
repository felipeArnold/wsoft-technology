<?php

namespace App\Filament\Resources\Creates\Suppliers\Schemas;

use App\Models\Person\Person;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components(Person::getFormSuppliers());
    }
}
