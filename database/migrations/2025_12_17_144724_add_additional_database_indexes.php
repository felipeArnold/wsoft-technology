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
        // Índices adicionais para service_orders
        // A tabela já possui um índice composto, mas índices individuais podem ajudar em queries específicas
        Schema::table('service_orders', function (Blueprint $table) {
            $table->index('status', 'idx_service_orders_status');
            $table->index('created_at', 'idx_service_orders_created_at');
            $table->index(['tenant_id', 'created_at'], 'idx_service_orders_tenant_created');
            $table->index(['person_id', 'status'], 'idx_service_orders_person_status');
        });

        // Índices adicionais para products
        // Adicionar índice em barcode para busca rápida por código de barras
        Schema::table('products', function (Blueprint $table) {
            $table->index('barcode', 'idx_products_barcode');
            $table->index(['tenant_id', 'stock'], 'idx_products_tenant_stock');
        });

        // Índices críticos para stock_movements
        // Esta tabela não tinha nenhum índice e é muito consultada
        Schema::table('stock_movements', function (Blueprint $table) {
            $table->index(['tenant_id', 'product_id'], 'idx_stock_movements_tenant_product');
            $table->index(['tenant_id', 'type'], 'idx_stock_movements_tenant_type');
            $table->index(['tenant_id', 'created_at'], 'idx_stock_movements_tenant_created');
            $table->index(['product_id', 'created_at'], 'idx_stock_movements_product_created');
            $table->index('type', 'idx_stock_movements_type');
        });

        // Índices adicionais para accounts (accounts_installments já tem bons índices)
        // Índice individual em status para queries de filtro simples
        Schema::table('accounts', function (Blueprint $table) {
            $table->index('status', 'idx_accounts_status');
            $table->index('type', 'idx_accounts_type');
        });

        // Índices para accounts_installments (melhorias adicionais)
        Schema::table('accounts_installments', function (Blueprint $table) {
            $table->index('status', 'idx_accounts_installments_status');
            $table->index(['tenant_id', 'status'], 'idx_accounts_installments_tenant_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_orders', function (Blueprint $table) {
            $table->dropIndex('idx_service_orders_status');
            $table->dropIndex('idx_service_orders_created_at');
            $table->dropIndex('idx_service_orders_tenant_created');
            $table->dropIndex('idx_service_orders_person_status');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_barcode');
            $table->dropIndex('idx_products_tenant_stock');
        });

        Schema::table('stock_movements', function (Blueprint $table) {
            $table->dropIndex('idx_stock_movements_tenant_product');
            $table->dropIndex('idx_stock_movements_tenant_type');
            $table->dropIndex('idx_stock_movements_tenant_created');
            $table->dropIndex('idx_stock_movements_product_created');
            $table->dropIndex('idx_stock_movements_type');
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->dropIndex('idx_accounts_status');
            $table->dropIndex('idx_accounts_type');
        });

        Schema::table('accounts_installments', function (Blueprint $table) {
            $table->dropIndex('idx_accounts_installments_status');
            $table->dropIndex('idx_accounts_installments_tenant_status');
        });
    }
};
