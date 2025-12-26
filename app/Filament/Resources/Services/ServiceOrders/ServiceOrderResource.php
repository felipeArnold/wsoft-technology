<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders;

use App\Filament\Resources\Services\ServiceOrders\Pages\CreateServiceOrder;
use App\Filament\Resources\Services\ServiceOrders\Pages\EditServiceOrder;
use App\Filament\Resources\Services\ServiceOrders\Pages\ListServiceOrders;
use App\Filament\Resources\Services\ServiceOrders\Pages\ViewServiceOrder;
use App\Filament\Resources\Services\ServiceOrders\Schemas\ServiceOrderForm;
use App\Filament\Resources\Services\ServiceOrders\Schemas\ServiceOrderInfolist;
use App\Filament\Resources\Services\ServiceOrders\Tables\ServiceOrdersTable;
use App\Models\ServiceOrder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class ServiceOrderResource extends Resource
{
    protected static ?string $model = ServiceOrder::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $recordTitleAttribute = 'number';

    protected static ?string $label = 'Ordem de Serviço';

    protected static ?int $navigationSort = 1;

    protected static string|UnitEnum|null $navigationGroup = 'Serviços';

    public static function form(Schema $schema): Schema
    {
        return ServiceOrderForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ServiceOrderInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceOrdersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\WarrantiesRelationManager::class,
            RelationManagers\AccountsReceivablesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceOrders::route('/'),
            'create' => CreateServiceOrder::route('/create'),
            'view' => ViewServiceOrder::route('/{record}'),
            'edit' => EditServiceOrder::route('/{record}/edit'),
        ];
    }
}
