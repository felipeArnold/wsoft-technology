<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Sales\Pages;

use App\Filament\Resources\Financial\Sales\SaleResource;
use App\Helpers\FormatterHelper;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

final class CreateSale extends CreateRecord
{
    protected static string $resource = SaleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['tenant_id'] = Filament::getTenant()->id;
        $data['user_id'] = auth()->id();
        $data['subtotal'] = FormatterHelper::toDecimal($data['subtotal'] ?? 0);
        $data['discount_amount'] = FormatterHelper::toDecimal($data['discount_amount'] ?? 0);
        $data['total'] = FormatterHelper::toDecimal($data['total'] ?? 0);

        return $data;
    }
}
