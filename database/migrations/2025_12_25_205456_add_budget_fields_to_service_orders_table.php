<?php

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
        Schema::table('service_orders', function (Blueprint $table) {
            $table->date('budget_valid_until')->nullable()->after('completion_date');
            $table->string('budget_approval_status')->nullable()->default('pending')->after('budget_valid_until');
            $table->timestamp('budget_approved_at')->nullable()->after('budget_approval_status');
            $table->text('budget_notes')->nullable()->after('budget_approved_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_orders', function (Blueprint $table) {
            $table->dropColumn([
                'budget_valid_until',
                'budget_approval_status',
                'budget_approved_at',
                'budget_notes',
            ]);
        });
    }
};
