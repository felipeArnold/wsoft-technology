<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\DigitalSignature\Envelopes\Pages;

use App\Filament\Resources\Services\DigitalSignature\Envelopes\EnvelopeResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateEnvelope extends CreateRecord
{
    protected static string $resource = EnvelopeResource::class;
}
