<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Budegets\Schemas;

use App\Enum\ServiceOrderStatus;
use App\Models\ServiceOrder;
use Filament\Schemas\Schema;

final class BudegetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components(ServiceOrder::getForm(
            disableStatus: false,
            defaultStatus: ServiceOrderStatus::BUDGET
        ));
    }
}
