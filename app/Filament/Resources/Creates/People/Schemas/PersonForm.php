<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People\Schemas;

use App\Models\Category;
use App\Models\Person\Person;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class PersonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            ...Person::getForm(),
            Section::make('Etiquetas')
                ->description('Classifique este cliente/fornecedor com etiquetas')
                ->icon('heroicon-o-tag')
                ->schema([
                    CheckboxList::make('categories')
                        ->label('Etiquetas')
                        ->relationship('categories', 'name')
                        ->options(fn () => Category::query()->pluck('name', 'id'))
                        ->searchable()
                        ->bulkToggleable()
                        ->gridDirection('row')
                        ->columns(3)
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->collapsed()
                ->columnSpanFull(),
        ]);
    }
}
