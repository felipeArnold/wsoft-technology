<?php

declare(strict_types=1);

namespace App\Filament\Resources\Stock\StockMovements;

use App\Filament\Resources\Stock\StockMovements\Pages\ListStockMovements;
use App\Filament\Resources\Stock\StockMovements\Schemas\StockMovementForm;
use App\Filament\Resources\Stock\StockMovements\Tables\StockMovementsTable;
use App\Models\StockMovement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class StockMovementResource extends Resource
{
    protected static ?string $model = StockMovement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowsRightLeft;

    protected static ?string $navigationLabel = 'Movimentações';

    protected static ?string $label = 'Movimentação';

    protected static ?string $pluralLabel = 'Movimentações de Estoque';

    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return StockMovementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StockMovementsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStockMovements::route('/'),
        ];
    }
}
