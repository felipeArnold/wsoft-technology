<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Commissions;

use App\Filament\Resources\Financial\Commissions\Pages\EditCommission;
use App\Filament\Resources\Financial\Commissions\Pages\ListCommissions;
use App\Filament\Resources\Financial\Commissions\Pages\ViewCommission;
use App\Filament\Resources\Financial\Commissions\Schemas\CommissionForm;
use App\Filament\Resources\Financial\Commissions\Schemas\CommissionInfolist;
use App\Filament\Resources\Financial\Commissions\Tables\CommissionsTable;
use App\Models\Commission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class CommissionResource extends Resource
{
    protected static ?string $model = Commission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static ?string $label = 'Comissão';

    protected static ?string $pluralLabel = 'Comissões';

    protected static string|UnitEnum|null $navigationGroup = 'Financeiro';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return CommissionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CommissionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommissionsTable::configure($table);
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
            'index' => ListCommissions::route('/'),
            'view' => ViewCommission::route('/{record}'),
            'edit' => EditCommission::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) self::getModel()::query()->where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $pendingCount = self::getModel()::query()->where('status', 'pending')->count();

        return $pendingCount > 0 ? 'warning' : 'success';
    }
}
