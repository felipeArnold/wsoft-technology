<?php

declare(strict_types=1);

use App\Models\Person\Person;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class);
            $table->foreignIdFor(Person::class)
                ->nullable()
                ->constrained('people')
                ->nullOnDelete();
            $table->string('name');
            $table->string('sku')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price_sale', 10, 2)->default(0.00);
            $table->decimal('price_cost', 10, 2)->default(0.00);
            $table->decimal('net_profit', 10, 2)
                ->storedAs('price_sale - price_cost');
            $table->integer('stock')->default(0);
            $table->integer('stock_alert')->default(0);
            $table->text('attachment')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['tenant_id', 'person_id', 'name', 'sku', 'stock']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
