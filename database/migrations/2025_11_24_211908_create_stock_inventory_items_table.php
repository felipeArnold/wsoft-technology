<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\StockInventory;
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
        Schema::create('stock_inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StockInventory::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->integer('system_quantity')->comment('Quantidade no sistema');
            $table->integer('counted_quantity')->nullable()->comment('Quantidade contada fisicamente');
            $table->integer('difference')->nullable()->comment('Diferença (contado - sistema)');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_inventory_items');
    }
};
