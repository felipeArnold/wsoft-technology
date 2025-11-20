<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings;

use App\Filament\Clusters\Settings\Users\UserResource;
use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

final class SettingsCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static string|UnitEnum|null $navigationGroup = 'Configurações';

    protected static ?string $label = 'Configurações';

    protected static ?string $title = 'Configurações';

    public static function getNavigationUrl(): string
    {
        if (! Filament::getTenant()) {
            return '#';
        }

        return UserResource::getUrl('index');
    }
}
