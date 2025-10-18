<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\EmailTemplates\Pages;

use App\Filament\Clusters\Settings\EmailTemplates\EmailTemplateResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewEmailTemplate extends ViewRecord
{
    protected static string $resource = EmailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
