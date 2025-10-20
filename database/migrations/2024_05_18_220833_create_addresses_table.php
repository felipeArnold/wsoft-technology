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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->string('postal_code', 10);
            $table->string('street', 50);
            $table->string('number', 10)->nullable();
            $table->string('complement', 50)->nullable();
            $table->string('district', 50);
            $table->string('city', 50);
            $table->string('state', 2);
            $table->timestamps();
            $table->index(['addressable_type', 'addressable_id', 'postal_code', 'city']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
