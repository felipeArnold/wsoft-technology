<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\EmailTemplates\Pages;

use App\Filament\Clusters\Settings\EmailTemplates\EmailTemplateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListEmailTemplates extends ListRecords
{
    protected static string $resource = EmailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Novo Template')
                ->icon('heroicon-o-plus'),
        ];
    }
}
