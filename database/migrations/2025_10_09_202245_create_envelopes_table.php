<?php

declare(strict_types=1);

use App\Models\Tenant;
use App\Models\User;
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
        Schema::create('envelopes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('documents')->nullable(); // Array de documentos
            $table->date('deadline')->nullable(); // Prazo para assinatura
            $table->string('status')->default('draft');
            $table->timestamps();
            $table->index(['tenant_id', 'user_id', 'name', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envelopes');
    }
};
