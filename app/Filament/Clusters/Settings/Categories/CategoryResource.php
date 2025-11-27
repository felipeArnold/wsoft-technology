<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Categories;

use App\Filament\Clusters\Settings\Categories\Pages\ListCategories;
use App\Filament\Clusters\Settings\Categories\Schemas\CategoryForm;
use App\Filament\Clusters\Settings\Categories\Schemas\CategoryInfolist;
use App\Filament\Clusters\Settings\Categories\Tables\CategoriesTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\Category;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

final class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Tag;

    protected static ?string $cluster = SettingsCluster::class;

    protected static ?string $label = 'Etiqueta';

    protected static ?string $recordTitleAttribute = 'Etiqueta';

    protected static string|UnitEnum|null $navigationGroup = 'Personalização';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategories::route('/'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
