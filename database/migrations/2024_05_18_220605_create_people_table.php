<?php

declare(strict_types=1);

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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name', 50);
            $table->string('surname', 50)->nullable();
            $table->string('document', 14)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('nationality', 50)->nullable();
            $table->string('naturalness', 50)->nullable();
            $table->string('profession', 50)->nullable();
            $table->boolean('is_client')->default(false);
            $table->boolean('is_supplier')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['tenant_id', 'name', 'surname', 'document']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
