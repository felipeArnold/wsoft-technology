<?php

declare(strict_types=1);

use App\Models\Product;
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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->enum('type', ['in', 'out', 'adjustment'])->comment('in=entrada, out=saída, adjustment=ajuste');
            $table->integer('quantity');
            $table->integer('stock_before')->comment('Estoque antes da movimentação');
            $table->integer('stock_after')->comment('Estoque depois da movimentação');
            $table->decimal('unit_cost', 10, 2)->nullable()->comment('Custo unitário na entrada');
            $table->text('reason')->nullable()->comment('Motivo da movimentação');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
