<?php

declare(strict_types=1);

use App\Models\Sale;
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
        Schema::table('commissions', function (Blueprint $table) {
            // Tornar service_order_id nullable pois agora pode ser comissão de venda
            $table->foreignId('service_order_id')->nullable()->change();

            // Adicionar campo para vendas
            $table->foreignIdFor(Sale::class)->nullable()->after('service_order_id')->constrained()->cascadeOnDelete();

            // Renomear labor_value_base para sale_value_base (mais genérico)
            $table->renameColumn('labor_value_base', 'base_value');

            // Adicionar tipo de comissão
            $table->enum('type', ['service_order', 'sale'])->after('sale_id')->default('service_order');

            // Adicionar índice
            $table->index(['sale_id'], 'idx_commissions_sale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commissions', function (Blueprint $table) {
            $table->dropForeign(['sale_id']);
            $table->dropColumn(['sale_id', 'type']);
            $table->renameColumn('base_value', 'labor_value_base');
            $table->foreignId('service_order_id')->nullable(false)->change();
        });
    }
};
