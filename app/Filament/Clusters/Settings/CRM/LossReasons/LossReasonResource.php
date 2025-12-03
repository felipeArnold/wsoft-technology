<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\LossReasons;

use App\Filament\Clusters\Settings\CRM\LossReasons\Pages\ListLossReasons;
use App\Filament\Clusters\Settings\CRM\LossReasons\Schemas\LossReasonForm;
use App\Filament\Clusters\Settings\CRM\LossReasons\Schemas\LossReasonInfolist;
use App\Filament\Clusters\Settings\CRM\LossReasons\Tables\LossReasonsTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\LossReason;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class LossReasonResource extends Resource
{
    protected static ?string $model = LossReason::class;

    protected static ?string $slug = 'loss-reasons';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedXCircle;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Motivos de Perda';

    protected static ?string $pluralLabel = 'Motivos de Perda';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 5;

    protected static ?string $cluster = SettingsCluster::class;

    public static function form(Schema $schema): Schema
    {
        return LossReasonForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LossReasonInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LossReasonsTable::configure($table);
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
            'index' => ListLossReasons::route('/'),
        ];
    }
}
