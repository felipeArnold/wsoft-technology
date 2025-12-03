<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\LossReasons\Pages;

use App\Filament\Clusters\Settings\CRM\LossReasons\LossReasonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListLossReasons extends ListRecords
{
    protected static string $resource = LossReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Novo Motivo')
                ->icon('heroicon-o-plus'),
        ];
    }
}
