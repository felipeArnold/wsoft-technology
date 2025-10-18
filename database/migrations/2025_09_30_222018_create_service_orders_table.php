<?php

declare(strict_types=1);

use App\Models\Person\Person;
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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(Person::class)->nullable();
            $table->string('number')->unique();
            $table->enum('status', ['draft', 'in_progress', 'completed', 'cancelled'])->default('draft');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->date('opening_date');
            $table->date('expected_completion_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->text('description')->nullable();
            $table->text('observations')->nullable();
            $table->decimal('total_value', 10, 2)->default(0);
            $table->decimal('labor_value', 10, 2)->default(0);
            $table->decimal('parts_value', 10, 2)->default(0);
            $table->string('warranty_period')->nullable();
            $table->text('technical_report')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['tenant_id', 'user_id', 'person_id', 'status', 'priority']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
