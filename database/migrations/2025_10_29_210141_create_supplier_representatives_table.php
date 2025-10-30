<?php

declare(strict_types=1);

use App\Models\Person\Person;
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
        Schema::create('supplier_representatives', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Person::class, 'supplier_id')
                ->constrained('people')
                ->cascadeOnDelete();
            $table->string('name', 50);
            $table->string('position', 50)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['supplier_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_representatives');
    }
};
