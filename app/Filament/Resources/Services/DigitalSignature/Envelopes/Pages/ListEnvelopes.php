<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\DigitalSignature\Envelopes\Pages;

use App\Filament\Resources\Services\DigitalSignature\Envelopes\EnvelopeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

final class ListEnvelopes extends ListRecords
{
    protected static string $resource = EnvelopeResource::class;

    public function getTabs(): array
    {
        return [
            'draft' => Tab::make()
                ->label('Rascunhos')
                ->icon('heroicon-o-pencil-square')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'draft')),
            'sent' => Tab::make()
                ->label('Em andamento')
                ->icon('heroicon-o-paper-airplane')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'sent')),
            'signed' => Tab::make()
                ->label('Assinados')
                ->icon('heroicon-o-check-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'signed')),
            'expired' => Tab::make()
                ->label('Expirados')
                ->icon('heroicon-o-calendar')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'expired')),
            'cancelled' => Tab::make()
                ->label('Cancelados')
                ->icon('heroicon-o-x-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'cancelled')),
            'all' => Tab::make()
                ->label('Todos')
                ->icon('heroicon-o-inbox')
                ->badgeColor('gray')
                ->modifyQueryUsing(fn (Builder $query) => $query),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Novo Envelope')
                ->icon('heroicon-o-plus'),
        ];
    }
}
