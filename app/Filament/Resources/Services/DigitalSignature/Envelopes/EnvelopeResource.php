<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\DigitalSignature\Envelopes;

use App\Filament\Resources\Services\DigitalSignature\Envelopes\Pages\ListEnvelopes;
use App\Filament\Resources\Services\DigitalSignature\Envelopes\Schemas\EnvelopeForm;
use App\Filament\Resources\Services\DigitalSignature\Envelopes\Tables\EnvelopesTable;
use App\Models\DigitalSignature\Envelope;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class EnvelopeResource extends Resource
{
    protected static ?string $model = Envelope::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Assinatura Digital';

    protected static ?string $pluralLabel = 'Assinatura Digital';

    protected static string|UnitEnum|null $navigationGroup = 'Serviços';

    protected static ?int $navigationSort = 3;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return EnvelopeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EnvelopesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEnvelopes::route('/'),
        ];
    }
}
