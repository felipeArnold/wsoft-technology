<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Companies\Pages;

use App\Filament\Clusters\Settings\Companies\CompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

final class ViewCompany extends ViewRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
