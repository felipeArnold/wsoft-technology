<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Tenant;
use App\Models\User;

final class TenantPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tenant $tenant): bool
    {
        return $user->tenants()->where('tenants.id', $tenant->id)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tenant $tenant): bool
    {
        return $user->tenants()->where('tenants.id', $tenant->id)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tenant $tenant): bool
    {
        return $user->tenants()->where('tenants.id', $tenant->id)->exists();
    }
}
