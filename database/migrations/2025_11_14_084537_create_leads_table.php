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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('whatsapp');
            $table->string('email');
            $table->string('oficina');
            $table->string('origem')->default('landing_oficina'); // Para tracking de origem
            $table->string('status')->default('novo'); // novo, contatado, convertido, perdido
            $table->text('observacoes')->nullable();
            $table->timestamps();

            // Índices para busca
            $table->index('email');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
