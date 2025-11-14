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
        Schema::table('leads', function (Blueprint $table) {
            // Renomear coluna 'oficina' para 'company_name' (mais genérico)
            $table->renameColumn('oficina', 'company_name');

            // Renomear 'nome' para 'name' (padrão internacional)
            $table->renameColumn('nome', 'name');

            // Renomear 'whatsapp' para 'phone' (mais genérico)
            $table->renameColumn('whatsapp', 'phone');

            // Renomear 'origem' para 'source' (mais genérico)
            $table->renameColumn('origem', 'source');

            // Renomear 'observacoes' para 'notes' (mais genérico)
            $table->renameColumn('observacoes', 'notes');
        });

        // Atualizar valores default existentes
        Schema::table('leads', function (Blueprint $table) {
            $table->string('source')->default('landing')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            // Reverter renomeações
            $table->renameColumn('company_name', 'oficina');
            $table->renameColumn('name', 'nome');
            $table->renameColumn('phone', 'whatsapp');
            $table->renameColumn('source', 'origem');
            $table->renameColumn('notes', 'observacoes');
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->string('source')->default('landing_oficina')->change();
        });
    }
};
