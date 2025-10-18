<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class ServiceOrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações da Ordem de Serviço')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->description('Dados básicos e status da O.S.')
                    ->schema([
                        TextEntry::make('number')
                            ->label('Número')
                            ->icon('heroicon-o-hashtag'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->formatStateUsing(fn ($state) => match ($state) {
                                'draft' => 'Rascunho',
                                'in_progress' => 'Em Andamento',
                                'completed' => 'Concluída',
                                'cancelled' => 'Cancelada',
                                default => ucfirst((string) $state),
                            })
                            ->color(fn ($state) => match ($state) {
                                'draft' => 'gray',
                                'in_progress' => 'warning',
                                'completed' => 'success',
                                'cancelled' => 'danger',
                                default => 'gray',
                            })
                            ->icon('heroicon-o-sparkles'),
                        TextEntry::make('priority')
                            ->label('Prioridade')
                            ->badge()
                            ->formatStateUsing(fn ($state) => match ($state) {
                                'low' => 'Baixa',
                                'medium' => 'Média',
                                'high' => 'Alta',
                                'urgent' => 'Urgente',
                                default => ucfirst((string) $state),
                            })
                            ->color(fn ($state) => match ($state) {
                                'low' => 'success',
                                'medium' => 'warning',
                                'high' => 'danger',
                                'urgent' => 'danger',
                                default => 'gray',
                            })
                            ->icon('heroicon-o-bolt'),
                        TextEntry::make('opening_date')
                            ->label('Data de Abertura')
                            ->date('d/m/Y')
                            ->icon('heroicon-o-calendar'),
                        TextEntry::make('expected_completion_date')
                            ->label('Previsão de Conclusão')
                            ->date('d/m/Y')
                            ->icon('heroicon-o-clock'),
                        TextEntry::make('completion_date')
                            ->label('Data de Conclusão')
                            ->date('d/m/Y')
                            ->icon('heroicon-o-check-badge'),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make('Cliente e Responsável')
                    ->icon('heroicon-o-users')
                    ->description('Cliente e responsável técnico pela O.S.')
                    ->schema([
                        TextEntry::make('person.name')
                            ->label('Cliente')
                            ->icon('heroicon-o-user'),
                        TextEntry::make('user.name')
                            ->label('Responsável Técnico')
                            ->icon('heroicon-o-user-circle'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Valores e Garantia')
                    ->icon('heroicon-o-currency-dollar')
                    ->description('Valores do serviço e período de garantia')
                    ->schema([
                        TextEntry::make('labor_value')
                            ->label('Mão de Obra')
                            ->numeric()
                            ->money('BRL'),
                        TextEntry::make('parts_value')
                            ->label('Peças')
                            ->numeric()
                            ->money('BRL'),
                        TextEntry::make('total_value')
                            ->label('Total')
                            ->numeric()
                            ->money('BRL')
                            ->color('primary')
                            ->badge(),
                        TextEntry::make('warranty_period')
                            ->label('Garantia')
                            ->icon('heroicon-o-shield-check'),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make('Descrição do Serviço')
                    ->icon('heroicon-o-document-text')
                    ->description('Descrição, observações e relatório técnico')
                    ->schema([
                        TextEntry::make('description')
                            ->label('Descrição')
                            ->html()
                            ->prose()
                            ->columnSpanFull(),
                        TextEntry::make('observations')
                            ->label('Observações')
                            ->html()
                            ->prose()
                            ->columnSpanFull(),
                        TextEntry::make('technical_report')
                            ->label('Relatório Técnico')
                            ->html()
                            ->prose()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Section::make('Anexos')
                    ->icon('heroicon-o-paper-clip')
                    ->description('Documentos e imagens relacionados à O.S.')
                    ->schema([
                        ImageEntry::make('attachments')
                            ->label('Anexos')
                            ->stacked()
                            ->circular(false)
                            ->limit(6)
                            ->hidden(fn ($state) => empty($state)),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
