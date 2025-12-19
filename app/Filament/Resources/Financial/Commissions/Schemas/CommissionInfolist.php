<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Commissions\Schemas;

use App\Filament\Resources\Services\ServiceOrders\ServiceOrderResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class CommissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações da Comissão')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        TextEntry::make('serviceOrder.number')
                            ->label('Ordem de Serviço')
                            ->url(fn ($record) => $record->service_order ? ServiceOrderResource::getUrl('view', ['record' => $record->service_order]) : null)
                            ->color('primary')
                            ->columnSpan(1),
                        TextEntry::make('user.name')
                            ->label('Técnico')
                            ->columnSpan(1),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->columnSpan(1),
                        TextEntry::make('labor_value_base')
                            ->label('Valor Base (Mão de Obra)')
                            ->money('BRL')
                            ->columnSpan(1),
                        TextEntry::make('commission_percentage')
                            ->label('Percentual de Comissão')
                            ->formatStateUsing(fn ($state) => number_format((float) $state, 2, ',', '.').'%')
                            ->columnSpan(1),
                        TextEntry::make('commission_amount')
                            ->label('Valor da Comissão')
                            ->money('BRL')
                            ->weight('bold')
                            ->color('success')
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make('Informações de Pagamento')
                    ->icon('heroicon-o-credit-card')
                    ->schema([
                        TextEntry::make('paid_at')
                            ->label('Data de Pagamento')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('Não pago')
                            ->columnSpan(1),
                        TextEntry::make('paidBy.name')
                            ->label('Pago Por')
                            ->placeholder('—')
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->visible(fn ($record) => $record->paid_at !== null),

                Section::make('Observações')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        TextEntry::make('notes')
                            ->label('Notas')
                            ->html()
                            ->placeholder('Sem observações')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->visible(fn ($record) => $record->notes !== null),

                Section::make('Informações do Sistema')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i')
                            ->columnSpan(1),
                        TextEntry::make('updated_at')
                            ->label('Atualizado em')
                            ->dateTime('d/m/Y H:i')
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsible(),
            ]);
    }
}
