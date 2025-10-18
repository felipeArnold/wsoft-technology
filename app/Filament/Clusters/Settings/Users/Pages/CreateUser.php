<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Users\Pages;

use App\Filament\Clusters\Settings\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
