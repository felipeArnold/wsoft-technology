<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\LossReasons\Pages;

use App\Filament\Clusters\Settings\CRM\LossReasons\LossReasonResource;
use Exception;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditLossReason extends EditRecord
{
    protected static string $resource = LossReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
                ->disabled(fn ($record) => $record->is_default === true)
                ->before(function ($record) {
                    if ($record->is_default) {
                        throw new Exception('Default loss reasons cannot be deleted.');
                    }
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
