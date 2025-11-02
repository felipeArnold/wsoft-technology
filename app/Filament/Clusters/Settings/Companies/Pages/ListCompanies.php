<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Companies\Pages;

use App\Filament\Clusters\Settings\Companies\CompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListCompanies extends ListRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
