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
        Schema::create('signers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)->nullable();
            $table->foreignId('envelope_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('document_number'); // CPF/CNPJ
            $table->string('email');
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('signer_type'); // signer, witness, approver
            $table->boolean('signature_with_photo')->default(false);
            $table->string('document_front_back')->nullable();
            $table->string('rubric')->nullable(); // Rubric
            $table->string('status')->default('pending'); // pending, signed, rejected, expired
            $table->timestamp('signed_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
            $table->index(['tenant_id', 'envelope_id', 'email', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signers');
    }
};
