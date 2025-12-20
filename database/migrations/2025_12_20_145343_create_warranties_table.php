<?php

declare(strict_types=1);

use App\Models\Person\Person;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceOrder;
use App\Models\ServiceOrderProduct;
use App\Models\ServiceOrderService;
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
        Schema::create('warranties', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ServiceOrder::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ServiceOrderService::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ServiceOrderProduct::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Product::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Service::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Person::class)->constrained()->cascadeOnDelete();

            $table->enum('warranty_type', ['product', 'service', 'order'])->default('order');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration_days');
            $table->enum('status', ['active', 'expired', 'claimed', 'cancelled'])->default('active');

            $table->text('coverage_description')->nullable();
            $table->text('terms')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['tenant_id', 'status', 'end_date']);
            $table->index(['service_order_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warranties');
    }
};
