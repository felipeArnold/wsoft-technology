<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Companies\Pages;

use App\Filament\Clusters\Settings\Companies\CompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
