<?php

declare(strict_types=1);

namespace App\Filament\Resources\Stock\StockInventories;

use App\Filament\Resources\Stock\StockInventories\Pages\CreateStockInventory;
use App\Filament\Resources\Stock\StockInventories\Pages\EditStockInventory;
use App\Filament\Resources\Stock\StockInventories\Pages\ListStockInventories;
use App\Filament\Resources\Stock\StockInventories\RelationManagers\StockInventoryItemsRelationManager;
use App\Filament\Resources\Stock\StockInventories\Schemas\StockInventoryForm;
use App\Filament\Resources\Stock\StockInventories\Tables\StockInventoriesTable;
use App\Models\StockInventory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class StockInventoryResource extends Resource
{
    protected static ?string $model = StockInventory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $navigationLabel = 'Inventários';

    protected static ?string $label = 'Inventário';

    protected static ?string $pluralLabel = 'Inventários de Estoque';

    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return StockInventoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StockInventoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            StockInventoryItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStockInventories::route('/'),
            'create' => CreateStockInventory::route('/create'),
            'edit' => EditStockInventory::route('/{record}/edit'),
        ];
    }
}
