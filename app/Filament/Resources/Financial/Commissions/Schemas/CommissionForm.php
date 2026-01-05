<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Commissions\Schemas;

use App\Enum\Commission\CommissionStatusEnum;
use App\Filament\Components\PtbrMoney;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class CommissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações da Comissão')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        Placeholder::make('type_display')
                            ->label('Tipo de Comissão')
                            ->content(fn ($record) => $record ? match ($record->type) {
                                'service_order' => '🔧 Ordem de Serviço',
                                'sale' => '🛒 Venda',
                                default => '—',
                            } : '—')
                            ->columnSpan(1),
                        Select::make('service_order_id')
                            ->label('Ordem de Serviço')
                            ->relationship('serviceOrder', 'number')
                            ->searchable()
                            ->preload()
                            ->disabled()
                            ->visible(fn ($record) => $record && $record->type === 'service_order')
                            ->columnSpan(1),
                        Select::make('sale_id')
                            ->label('Venda')
                            ->relationship('sale', 'sale_number')
                            ->searchable()
                            ->preload()
                            ->disabled()
                            ->visible(fn ($record) => $record && $record->type === 'sale')
                            ->columnSpan(1),
                        Select::make('user_id')
                            ->label('Responsável')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->disabled()
                            ->columnSpan(1),
                        PtbrMoney::make('base_value')
                            ->label('Valor Base')
                            ->required()
                            ->disabled()
                            ->columnSpan(1),
                        Placeholder::make('commission_percentage_display')
                            ->label('Percentual de Comissão')
                            ->content(fn ($record) => $record ? number_format((float) $record->commission_percentage, 2, ',', '.').'%' : '—')
                            ->columnSpan(1),
                        PtbrMoney::make('commission_amount')
                            ->label('Valor da Comissão')
                            ->required()
                            ->disabled()
                            ->columnSpan(1),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                CommissionStatusEnum::PENDING->value => 'Pendente',
                                CommissionStatusEnum::PAID->value => 'Pago',
                            ])
                            ->native(false)
                            ->required()
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make('Informações de Pagamento')
                    ->icon('heroicon-o-credit-card')
                    ->schema([
                        DateTimePicker::make('paid_at')
                            ->label('Data de Pagamento')
                            ->native(false)
                            ->columnSpan(1),
                        Select::make('paid_by_user_id')
                            ->label('Pago Por')
                            ->relationship('paidBy', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->visible(fn ($record) => $record && $record->status === CommissionStatusEnum::PAID),

                Section::make('Observações')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        RichEditor::make('notes')
                            ->label('Notas')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
