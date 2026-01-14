<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Schemas;

use App\Models\ServiceOrder;
use Filament\Schemas\Schema;

final class ServiceOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components(ServiceOrder::getForm());
    }

}
