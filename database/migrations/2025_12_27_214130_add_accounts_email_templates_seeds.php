<?php

declare(strict_types=1);

use App\Actions\Tenant\SeedEmailTemplatesAction;
use App\Models\Tenant;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $action = new SeedEmailTemplatesAction();

        // Executa a action para todos os tenants já cadastrados
        Tenant::query()->each(function (Tenant $tenant) use ($action) {
            $action->execute($tenant);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove os templates de todos os tenants
        Tenant::query()->each(function (Tenant $tenant) {
            $tenant->emailTemplates()
                ->whereIn('context', ['ServiceOrder', 'AccountsPayable', 'AccountsReceivable', 'Overdue'])
                ->delete();
        });
    }
};
