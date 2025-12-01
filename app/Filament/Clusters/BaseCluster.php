<?php

declare(strict_types=1);

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

abstract class BaseCluster extends Cluster
{
    protected static bool $shouldRegisterNavigation = true;

    final public static function shouldRegisterNavigation(): bool
    {
        if (! static::$shouldRegisterNavigation) {
            return false;
        }

        return static::canAccessClusteredComponents();
    }
}
