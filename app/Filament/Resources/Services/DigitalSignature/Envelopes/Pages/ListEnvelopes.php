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
                ->badgeColor('secondary')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'draft')),
            'sent' => Tab::make()
                ->label('Enviados')
                ->badgeColor('primary')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'sent')),
            'signed' => Tab::make()
                ->label('Assinados')
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'signed')),
            'expired' => Tab::make()
                ->label('Expirados')
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'expired')),
            'cancelled' => Tab::make()
                ->label('Cancelados')
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'cancelled')),
            'all' => Tab::make()
                ->label('Todos')
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
