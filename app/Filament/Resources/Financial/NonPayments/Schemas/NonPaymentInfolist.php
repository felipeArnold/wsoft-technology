<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\NonPayments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

final class NonPaymentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações da Inadimplência')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('accounts.person.name')
                                    ->label('Cliente')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->description(fn ($record) => $record->accounts?->person?->type === 'customer' ? 'Cliente' : 'Fornecedor'),
                                TextEntry::make('installment_number')
                                    ->label('Parcela')
                                    ->formatStateUsing(function ($state, $record) {
                                        $accounts = $record->accounts;
                                        if (! $accounts) {
                                            return $state;
                                        }

                                        return Str::of($state)->padLeft(2, '0').'/'.Str::of($accounts->parcels)->padLeft(2, '0');
                                    })
                                    ->badge()
                                    ->color('danger'),
                                TextEntry::make('amount')
                                    ->label('Valor em Atraso')
                                    ->money('BRL')
                                    ->weight('bold')
                                    ->color('danger')
                                    ->size('lg'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('due_date')
                                    ->label('Data de Vencimento')
                                    ->date('d/m/Y')
                                    ->color('danger')
                                    ->weight('bold')
                                    ->description(function ($record) {
                                        $daysOverdue = round($record->due_date->diffInDays(now()), 0);

                                        return "{$daysOverdue} dias em atraso";
                                    }),
                                TextEntry::make('accounts.payment_method')
                                    ->label('Forma de Pagamento')
                                    ->badge()
                                    ->formatStateUsing(fn ($state) => $state?->getLabel() ?? $state)
                                    ->color('gray'),
                            ]),
                    ])
                    ->columnSpanFull(),

                Section::make('Detalhes da Conta')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('accounts.reference_number')
                                    ->label('Número de Referência')
                                    ->placeholder('Não informado')
                                    ->color('gray'),
                                TextEntry::make('accounts.category')
                                    ->label('Categoria')
                                    ->badge()
                                    ->color('gray')
                                    ->placeholder('Não categorizada'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('accounts.user.name')
                                    ->label('Responsável')
                                    ->color('primary')
                                    ->icon('heroicon-o-user'),
                                TextEntry::make('accounts.created_at')
                                    ->label('Conta Criada em')
                                    ->date('d/m/Y H:i')
                                    ->color('gray')
                                    ->icon('heroicon-o-calendar'),
                            ]),
                    ])
                    ->columnSpanFull(),

                Section::make('Informações de Contato')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('accounts.person.phones.0.number')
                                    ->label('Telefone Principal')
                                    ->placeholder('Não informado')
                                    ->color('gray')
                                    ->icon('heroicon-o-phone'),
                                TextEntry::make('accounts.person.emails.0.email')
                                    ->label('E-mail Principal')
                                    ->placeholder('Não informado')
                                    ->color('gray')
                                    ->icon('heroicon-o-envelope'),
                            ]),
                        TextEntry::make('accounts.person.addresses.0.full_address')
                            ->label('Endereço')
                            ->placeholder('Não informado')
                            ->color('gray')
                            ->icon('heroicon-o-map-pin')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->visible(fn ($record) => $record->accounts?->person),

                Section::make('Histórico de Pagamentos')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        ViewEntry::make('payment_history')
                            ->view('filament.infolists.components.payment-history')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Section::make('Ações Recomendadas')
                    ->icon('heroicon-o-light-bulb')
                    ->schema([
                        ViewEntry::make('recommended_actions')
                            ->view('filament.infolists.components.recommended-actions')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
