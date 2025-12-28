<?php

declare(strict_types=1);

namespace App\Observers;

use App\Actions\Tenant\SeedEmailTemplatesAction;
use App\Models\Tenant;

final class TenantObserver
{
    public function created(Tenant $tenant): void
    {
        (new SeedEmailTemplatesAction())->execute($tenant);
    }
}
