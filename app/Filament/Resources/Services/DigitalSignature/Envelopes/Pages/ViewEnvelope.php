<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\DigitalSignature\Envelopes\Pages;

use App\Filament\Resources\Services\DigitalSignature\Envelopes\EnvelopeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewEnvelope extends ViewRecord
{
    protected static string $resource = EnvelopeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Editar Envelope')->icon('heroicon-o-pencil'),
        ];
    }
}
