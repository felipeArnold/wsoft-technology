<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\DigitalSignature\Envelopes\Pages;

use App\Filament\Resources\Services\DigitalSignature\Envelopes\EnvelopeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditEnvelope extends EditRecord
{
    protected static string $resource = EnvelopeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->label('Excluir Envelope')->icon('heroicon-o-trash'),
        ];
    }
}
