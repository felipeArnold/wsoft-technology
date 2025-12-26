<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_orders', function (Blueprint $table) {
            // Appointment datetime fields
            $table->dateTime('scheduled_start_at')
                ->nullable()
                ->after('expected_completion_date');

            $table->dateTime('scheduled_end_at')
                ->nullable()
                ->after('scheduled_start_at');

            // Appointment confirmation tracking
            $table->boolean('appointment_confirmed')
                ->default(false)
                ->after('scheduled_end_at');

            $table->timestamp('appointment_confirmation_sent_at')
                ->nullable()
                ->after('appointment_confirmed');

            $table->timestamp('appointment_reminder_sent_at')
                ->nullable()
                ->after('appointment_confirmation_sent_at');

            // Add index for scheduled queries
            $table->index(['scheduled_start_at', 'tenant_id'], 'idx_scheduled_start_tenant');
        });
    }

    public function down(): void
    {
        Schema::table('service_orders', function (Blueprint $table) {
            $table->dropIndex('idx_scheduled_start_tenant');
            $table->dropColumn([
                'scheduled_start_at',
                'scheduled_end_at',
                'appointment_confirmed',
                'appointment_confirmation_sent_at',
                'appointment_reminder_sent_at',
            ]);
        });
    }
};
