<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People;

use App\Filament\Resources\Creates\People\Pages\CreatePerson;
use App\Filament\Resources\Creates\People\Pages\EditPerson;
use App\Filament\Resources\Creates\People\Pages\ListPeople;
use App\Filament\Resources\Creates\People\RelationManagers\ServicesOrdersRelationManager;
use App\Filament\Resources\Creates\People\Schemas\PersonForm;
use App\Filament\Resources\Creates\People\Tables\PeopleTable;
use App\Models\Person\Person;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

final class PersonResource extends Resource
{
    protected static ?string $model = Person::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Clientes';

    protected static string|UnitEnum|null $navigationGroup = 'Cadastros';

    protected static ?int $navigationSort = 1;

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'document',
            'surname',
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Nome' => $record->name,
            'Documento' => $record->document,
            'Apelido' => $record->surname,
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return PersonForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PeopleTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ServicesOrdersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPeople::route('/'),
            'create' => CreatePerson::route('/create'),
            'edit' => EditPerson::route('/{record}/edit'),
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
