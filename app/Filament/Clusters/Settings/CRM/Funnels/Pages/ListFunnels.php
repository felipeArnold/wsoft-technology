<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Funnels\Pages;

use App\Filament\Clusters\Settings\CRM\Funnels\FunnelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListFunnels extends ListRecords
{
    protected static string $resource = FunnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Novo Funil')
                ->icon('heroicon-o-plus'),
        ];
    }
}
