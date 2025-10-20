<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Users;

use App\Filament\Clusters\Settings\SettingsCluster;
use App\Filament\Clusters\Settings\Users\Pages\CreateUser;
use App\Filament\Clusters\Settings\Users\Pages\EditUser;
use App\Filament\Clusters\Settings\Users\Pages\ListUsers;
use App\Filament\Clusters\Settings\Users\Pages\ViewUser;
use App\Filament\Clusters\Settings\Users\Schemas\UserForm;
use App\Filament\Clusters\Settings\Users\Schemas\UserInfolist;
use App\Filament\Clusters\Settings\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Usuário';

    protected static string|UnitEnum|null $navigationGroup = 'Equipe';

    protected static ?int $navigationSort = 1;

    protected static ?string $cluster = SettingsCluster::class;

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'),
//            'create' => CreateUser::route('/create'),
//            'view' => ViewUser::route('/{record}'),
//            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
