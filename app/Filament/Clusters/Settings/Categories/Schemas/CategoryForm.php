<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Categories\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->label('Nome'),
                Select::make('purpose')
                    ->options([
                        'Financeiro' => 'Financeiro',
                        'Contas a Pagar' => 'Contas a Pagar',
                        'Contas a Receber' => 'Contas a Receber',
                        'Estoque' => 'Estoque',
                        'Vendas' => 'Vendas',
                        'Clientes' => 'Clientes',
                        'Produtos' => 'Produtos',
                        'Serviços' => 'Serviços',
                        'Geral' => 'Geral',
                    ])
                    ->searchable()
                    ->placeholder('Selecione uma finalidade')
                    ->label('Finalidade'),
                ColorPicker::make('color')
                    ->label('Cor'),
                Textarea::make('description')
                    ->columnSpanFull()
                    ->label('Descrição'),
            ]);
    }
}
