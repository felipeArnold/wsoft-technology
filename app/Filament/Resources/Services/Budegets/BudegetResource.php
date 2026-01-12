<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Budegets;

use App\Enum\ServiceOrderStatus;
use App\Filament\Resources\Services\Budegets\Pages\CreateBudeget;
use App\Filament\Resources\Services\Budegets\Pages\EditBudeget;
use App\Filament\Resources\Services\Budegets\Pages\ListBudegets;
use App\Filament\Resources\Services\Budegets\Pages\ViewBudeget;
use App\Filament\Resources\Services\Budegets\Schemas\BudegetForm;
use App\Filament\Resources\Services\Budegets\Schemas\BudegetInfolist;
use App\Filament\Resources\Services\Budegets\Tables\BudegetsTable;
use App\Filament\Resources\Services\ServiceOrders\RelationManagers\AccountsReceivablesRelationManager;
use App\Filament\Resources\Services\ServiceOrders\RelationManagers\WarrantiesRelationManager;
use App\Models\ServiceOrder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

final class BudegetResource extends Resource
{
    protected static ?string $model = ServiceOrder::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'number';

    protected static ?string $label = 'Orçamento';

    protected static ?int $navigationSort = -1;

    protected static string|UnitEnum|null $navigationGroup = 'Serviços';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('status', ServiceOrderStatus::BUDGET);
    }

    public static function form(Schema $schema): Schema
    {
        return BudegetForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BudegetInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BudegetsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            WarrantiesRelationManager::class,
            AccountsReceivablesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBudegets::route('/'),
            'create' => CreateBudeget::route('/create'),
            'view' => ViewBudeget::route('/{record}'),
            'edit' => EditBudeget::route('/{record}/edit'),
        ];
    }
}
