<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Sales;

use App\Filament\Resources\Financial\Sales\Pages\CreateSale;
use App\Filament\Resources\Financial\Sales\Pages\EditSale;
use App\Filament\Resources\Financial\Sales\Pages\ListSales;
use App\Filament\Resources\Financial\Sales\Pages\ViewSale;
use App\Filament\Resources\Financial\Sales\Schemas\SaleForm;
use App\Filament\Resources\Financial\Sales\Schemas\SaleInfolist;
use App\Filament\Resources\Financial\Sales\Tables\SalesTable;
use App\Models\Sale;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static ?string $label = 'Venda';

    protected static ?string $pluralLabel = 'Vendas';

    protected static string|null|UnitEnum $navigationGroup = 'Financeiro';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return SaleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SaleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SalesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSales::route('/'),
            'create' => CreateSale::route('/create'),
            'view' => ViewSale::route('/{record}'),
            'edit' => EditSale::route('/{record}/edit'),
        ];
    }
}
