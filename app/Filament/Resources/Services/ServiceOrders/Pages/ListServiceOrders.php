<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Pages;

use App\Filament\Resources\Services\ServiceOrders\ServiceOrderResource;
use App\Models\ServiceOrder;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

final class ListServiceOrders extends ListRecords
{
    public ?string $activeTab = 'all';

    protected static string $resource = ServiceOrderResource::class;

    public function getTabs(): array
    {
        $serviceOrders = ServiceOrder::query()
            ->select('priority')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('priority')
            ->pluck('count', 'priority')
            ->toArray();

        return [
            'low' => Tab::make()
                ->label('Baixa')
                ->badge(fn () => collect($serviceOrders)->get('low', 0))
                ->badgeColor('gray')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('priority', 'low')),
            'medium' => Tab::make()
                ->label('Média')
                ->badge(fn () => collect($serviceOrders)->get('medium', 0))
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('priority', 'medium')),
            'high' => Tab::make()
                ->label('Alta')
                ->badge(fn () => collect($serviceOrders)->get('high', 0))
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('priority', 'high')),
            'urgent' => Tab::make()
                ->label('Urgente')
                ->badge(fn () => collect($serviceOrders)->get('urgent', 0))
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('priority', 'urgent')),
            'all' => Tab::make()
                ->label('Todas')
                ->badge(fn () => array_sum($serviceOrders))
                ->badgeColor('primary')
                ->modifyQueryUsing(fn (Builder $query) => $query),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Nova Ordem')->icon('heroicon-o-plus'),
        ];
    }
}
