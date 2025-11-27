<?php

declare(strict_types=1);

use App\Models\Category;
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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignIdFor(Category::class)->nullable()->after('person_id')->constrained()->nullOnDelete();
            $table->string('barcode')->nullable()->after('sku');
            $table->decimal('average_cost', 10, 2)->default(0.00)->after('price_cost')->comment('Custo médio calculado');
            $table->decimal('profit_margin', 5, 2)->default(0.00)->after('net_profit')->comment('Margem de lucro em %');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'barcode', 'average_cost', 'profit_margin']);
        });
    }
};
