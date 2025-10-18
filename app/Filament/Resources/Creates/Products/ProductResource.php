<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Products;

use App\Filament\Resources\Creates\Products\Pages\CreateProduct;
use App\Filament\Resources\Creates\Products\Pages\EditProduct;
use App\Filament\Resources\Creates\Products\Pages\ListProducts;
use App\Filament\Resources\Creates\Products\Pages\ViewProduct;
use App\Filament\Resources\Creates\Products\Schemas\ProductForm;
use App\Filament\Resources\Creates\Products\Schemas\ProductInfolist;
use App\Filament\Resources\Creates\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCube;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Produtos';

    protected static string|UnitEnum|null $navigationGroup = 'Cadastros';

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'view' => ViewProduct::route('/{record}'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
