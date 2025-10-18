<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\DigitalSignature\Envelopes;

use App\Filament\Resources\Services\DigitalSignature\Envelopes\Pages\CreateEnvelope;
use App\Filament\Resources\Services\DigitalSignature\Envelopes\Pages\EditEnvelope;
use App\Filament\Resources\Services\DigitalSignature\Envelopes\Pages\ListEnvelopes;
use App\Filament\Resources\Services\DigitalSignature\Envelopes\Pages\ViewEnvelope;
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

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Envelope;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Assinatura Digital';

    protected static string|UnitEnum|null $navigationGroup = 'Serviços';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return EnvelopeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EnvelopesTable::configure($table);
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
            'index' => ListEnvelopes::route('/'),
            'create' => CreateEnvelope::route('/create'),
            'view' => ViewEnvelope::route('/{record}'),
            'edit' => EditEnvelope::route('/{record}/edit'),
        ];
    }
}
