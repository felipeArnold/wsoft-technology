<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Suppliers\Schemas;

use App\Models\Person\Person;
use Filament\Schemas\Schema;

final class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components(Person::getFormSuppliers());
    }
}
