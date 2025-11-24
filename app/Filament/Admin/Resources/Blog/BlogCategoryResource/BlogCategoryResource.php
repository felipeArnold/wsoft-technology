<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Blog\BlogCategoryResource;

use App\Filament\Admin\Resources\Blog\BlogCategoryResource\Pages\CreateBlogCategory;
use App\Filament\Admin\Resources\Blog\BlogCategoryResource\Pages\EditBlogCategory;
use App\Filament\Admin\Resources\Blog\BlogCategoryResource\Pages\ListBlogCategories;
use App\Filament\Admin\Resources\Blog\BlogCategoryResource\Schemas\BlogCategoriesTable;
use App\Filament\Admin\Resources\Blog\BlogCategoryResource\Schemas\BlogCategoryForm;
use App\Models\Blog\BlogCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class BlogCategoryResource extends Resource
{
    protected static ?string $model = BlogCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolder;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Categorias';

    protected static ?string $pluralLabel = 'Categorias do Blog';

    protected static string|UnitEnum|null $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 1;

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug'];
    }

    public static function form(Schema $schema): Schema
    {
        return BlogCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BlogCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBlogCategories::route('/'),
            'create' => CreateBlogCategory::route('/create'),
            'edit' => EditBlogCategory::route('/{record}/edit'),
        ];
    }
}
