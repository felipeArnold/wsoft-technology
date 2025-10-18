<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\NonPayments\Pages;

use App\Filament\Resources\Financial\NonPayments\NonPaymentResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateNonPayment extends CreateRecord
{
    protected static string $resource = NonPaymentResource::class;
}
