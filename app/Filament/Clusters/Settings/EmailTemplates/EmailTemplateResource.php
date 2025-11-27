<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\EmailTemplates;

use App\Filament\Clusters\Settings\EmailTemplates\Pages\CreateEmailTemplate;
use App\Filament\Clusters\Settings\EmailTemplates\Pages\EditEmailTemplate;
use App\Filament\Clusters\Settings\EmailTemplates\Pages\ListEmailTemplates;
use App\Filament\Clusters\Settings\EmailTemplates\Pages\ViewEmailTemplate;
use App\Filament\Clusters\Settings\EmailTemplates\Schemas\EmailTemplateForm;
use App\Filament\Clusters\Settings\EmailTemplates\Schemas\EmailTemplateInfolist;
use App\Filament\Clusters\Settings\EmailTemplates\Tables\EmailTemplatesTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\EmailTemplate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class EmailTemplateResource extends Resource
{
    protected static ?string $model = EmailTemplate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Envelope;

    protected static ?string $label = 'Templates de E-mail';

    protected static string|UnitEnum|null $navigationGroup = 'Personalização';

    protected static ?int $navigationSort = 2;

    protected static ?string $cluster = SettingsCluster::class;

    public static function form(Schema $schema): Schema
    {
        return EmailTemplateForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EmailTemplateInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmailTemplatesTable::configure($table);
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
            'index' => ListEmailTemplates::route('/'),
            'create' => CreateEmailTemplate::route('/create'),
            'view' => ViewEmailTemplate::route('/{record}'),
            'edit' => EditEmailTemplate::route('/{record}/edit'),
        ];
    }
}
