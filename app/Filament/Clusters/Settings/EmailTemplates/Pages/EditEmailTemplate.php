<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\EmailTemplates\Pages;

use App\Filament\Clusters\Settings\EmailTemplates\EmailTemplateResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditEmailTemplate extends EditRecord
{
    protected static string $resource = EmailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
