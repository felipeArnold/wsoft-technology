<?php

declare(strict_types=1);

namespace App\Filament\Resources\Stock\StockInventories\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class StockInventoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Informações do Inventário')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->schema([
                        TextInput::make('reference')
                            ->label('Referência')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->default(fn () => 'INV-'.date('Ymd').'-'.mb_str_pad((string) rand(1, 9999), 4, '0', STR_PAD_LEFT))
                            ->helperText('Número de referência único do inventário')
                            ->columnSpan(1),

                        DatePicker::make('inventory_date')
                            ->label('Data do Inventário')
                            ->required()
                            ->default(now())
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->columnSpan(1),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Rascunho',
                                'in_progress' => 'Em Andamento',
                                'completed' => 'Concluído',
                                'cancelled' => 'Cancelado',
                            ])
                            ->required()
                            ->default('draft')
                            ->native(false)
                            ->columnSpan(1),

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(4)
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
