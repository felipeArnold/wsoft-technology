<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Vehicles;

use App\Filament\Resources\Creates\Vehicles\Pages\ListVehicles;
use App\Filament\Resources\Creates\Vehicles\Schemas\VehicleForm;
use App\Filament\Resources\Creates\Vehicles\Tables\VehiclesTable;
use App\Models\Vehicle;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

final class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;

    protected static ?string $recordTitleAttribute = 'plate';

    protected static ?string $label = 'Veículos';

    protected static string|UnitEnum|null $navigationGroup = 'Cadastros';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        $tenant = Filament::getTenant();

        if ($tenant === null) {
            return false;
        }

        return $tenant->type->isAutomotive();
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'plate',
            'brand',
            'model',
            'chassis',
            'person.name',
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Placa' => $record->plate,
            'Marca' => $record->brand,
            'Modelo' => $record->model,
            'Cliente' => $record->person->name,
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return VehicleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehiclesTable::configure($table);
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
            'index' => ListVehicles::route('/'),
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
