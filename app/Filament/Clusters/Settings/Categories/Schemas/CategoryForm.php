<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Categories\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                ColorPicker::make('color'),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
