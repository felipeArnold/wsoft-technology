<?php

declare(strict_types=1);

use App\Models\Person\Person;
use App\Models\Tenant;
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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Person::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('plate', 7)->unique();
            $table->string('brand', 50);
            $table->string('model', 50);
            $table->year('year')->nullable();
            $table->string('color', 30)->nullable();
            $table->string('chassis', 17)->nullable()->unique();
            $table->string('renavam', 11)->nullable()->unique();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['tenant_id', 'person_id', 'plate']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
