<?php

declare(strict_types=1);

namespace App\Filament\Resources\Sales\Sales\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class SaleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações da Venda')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextEntry::make('sale_number')
                            ->label('Número da Venda')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('person.name')
                            ->label('Cliente')
                            ->placeholder('Não informado'),
                        TextEntry::make('user.name')
                            ->label('Vendedor'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->formatStateUsing(fn ($state) => match ($state) {
                                'pending' => 'Pendente',
                                'completed' => 'Concluída',
                                'cancelled' => 'Cancelada',
                                default => $state,
                            })
                            ->color(fn ($state) => match ($state) {
                                'pending' => 'warning',
                                'completed' => 'success',
                                'cancelled' => 'danger',
                                default => 'gray',
                            }),
                    ])
                    ->columns(4),

                Section::make('Itens da Venda')
                    ->icon('heroicon-o-shopping-bag')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->hiddenLabel()
                            ->schema([
                                TextEntry::make('product_name')
                                    ->label('Produto'),
                                TextEntry::make('quantity')
                                    ->label('Quantidade'),
                                TextEntry::make('unit_price')
                                    ->label('Preço Unit.')
                                    ->money('BRL'),
                                TextEntry::make('discount')
                                    ->label('Desconto')
                                    ->money('BRL'),
                                TextEntry::make('total')
                                    ->label('Total')
                                    ->money('BRL')
                                    ->weight('bold'),
                            ])
                            ->columns(5)
                            ->columnSpanFull(),
                    ]),

                Section::make('Totais')
                    ->icon('heroicon-o-calculator')
                    ->schema([
                        TextEntry::make('subtotal')
                            ->label('Subtotal')
                            ->money('BRL'),
                        TextEntry::make('discount_amount')
                            ->label('Desconto')
                            ->money('BRL')
                            ->color('danger'),
                        TextEntry::make('total')
                            ->label('Total')
                            ->money('BRL')
                            ->weight('bold')
                            ->color('success'),
                        TextEntry::make('payment_method')
                            ->label('Pagamento')
                            ->badge()
                            ->formatStateUsing(fn ($state) => match ($state) {
                                'cash' => 'Dinheiro',
                                'card' => 'Cartão',
                                'pix' => 'PIX',
                                'installments' => 'Parcelado',
                                default => $state,
                            }),
                    ])
                    ->columns(4),

                Section::make('Observações')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        TextEntry::make('notes')
                            ->label('Observações')
                            ->html()
                            ->placeholder('Sem observações')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Informações do Sistema')
                    ->icon('heroicon-o-cog')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Criada em')
                            ->dateTime('d/m/Y H:i'),
                        TextEntry::make('updated_at')
                            ->label('Atualizada em')
                            ->dateTime('d/m/Y H:i'),
                        TextEntry::make('completed_at')
                            ->label('Concluída em')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('Não concluída'),
                    ])
                    ->columns(3)
                    ->collapsible()
                    ->collapsed(),
            ]);
    }
}
