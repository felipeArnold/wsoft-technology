<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Tenant;

final class UserObserver
{
    public function creating($user)
    {
        unset($user['password_confirmation']);

        Tenant::creating(function ($tenant) use ($user): void {
            $tenant->users()->attach($user);
        });
    }
}
