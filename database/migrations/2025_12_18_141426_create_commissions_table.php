<?php

declare(strict_types=1);

use App\Models\ServiceOrder;
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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ServiceOrder::class)->constrained()->cascadeOnDelete();

            // Commission calculation fields
            $table->decimal('commission_percentage', 5, 2)->comment('Percentage used at generation time');
            $table->decimal('labor_value_base', 10, 2)->comment('Service order labor_value used for calculation');
            $table->decimal('commission_amount', 10, 2)->comment('Calculated commission value');

            // Status tracking
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('paid_by_user_id')->nullable()->constrained('users');

            // Audit fields
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index(['tenant_id', 'user_id', 'status', 'created_at'], 'idx_commissions_main');
            $table->index(['service_order_id'], 'idx_commissions_service_order');
            $table->index(['status', 'paid_at'], 'idx_commissions_payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
