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
            // Checklist de entrada do veículo
            $table->json('entry_checklist')->nullable();
            $table->json('entry_checklist_images')->nullable();

            // Checklist de saída do veículo
            $table->json('exit_checklist')->nullable();
            $table->json('exit_checklist_images')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_orders', function (Blueprint $table) {
            $table->dropColumn([
                'entry_checklist',
                'entry_checklist_images',
                'exit_checklist',
                'exit_checklist_images',
            ]);
        });
    }
};
