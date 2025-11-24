<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Blog\BlogCategoryResource\Schemas;

use App\Models\Blog\BlogCategory;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

final class BlogCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações da Categoria')
                    ->icon('heroicon-o-folder')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set): void {
                                $set('slug', Str::slug($state));
                            })
                            ->columnSpan(1),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(BlogCategory::class, 'slug', ignoreRecord: true)
                            ->helperText('URL amigável da categoria')
                            ->columnSpan(1),

                        RichEditor::make('description')
                            ->label('Descrição')
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Ativa')
                            ->default(true)
                            ->helperText('Categorias inativas não serão exibidas no blog'),
                    ])
                    ->columns(2),
            ]);
    }
}
