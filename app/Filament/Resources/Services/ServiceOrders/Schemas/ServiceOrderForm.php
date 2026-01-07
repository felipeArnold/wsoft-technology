<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Schemas;

use App\Models\ServiceOrder;
use Filament\Schemas\Schema;

final class ServiceOrderForm
{
    /**
     * Configure the given Schema with service order form components.
     *
     * @param Schema $schema The schema to configure.
     * @return Schema The configured Schema containing service order form components.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema->components(ServiceOrder::getForm());
    }

}