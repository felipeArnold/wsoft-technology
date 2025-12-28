<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add index for accounts table type column (used in whereHas queries)
        Schema::table('accounts', function (Blueprint $table) {
            if (! Schema::hasIndex('accounts', 'idx_accounts_type')) {
                $table->index('type', 'idx_accounts_type');
            }
        });

        // Add index for accounts foreign key in accounts_installments
        // This helps with the joins when loading relationships
        Schema::table('accounts_installments', function (Blueprint $table) {
            if (! Schema::hasIndex('accounts_installments', 'accounts_installments_accounts_id_index')) {
                $table->index('accounts_id');
            }
        });

        // Add index for person_id in accounts table
        // This helps when joining with person table
        Schema::table('accounts', function (Blueprint $table) {
            if (! Schema::hasIndex('accounts', 'accounts_person_id_index')) {
                $table->index('person_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropIndex('idx_accounts_type');
        });

        Schema::table('accounts_installments', function (Blueprint $table) {
            if (Schema::hasIndex('accounts_installments', 'accounts_installments_accounts_id_index')) {
                $table->dropIndex('accounts_installments_accounts_id_index');
            }
        });

        Schema::table('accounts', function (Blueprint $table) {
            if (Schema::hasIndex('accounts', 'accounts_person_id_index')) {
                $table->dropIndex('accounts_person_id_index');
            }
        });
    }
};
