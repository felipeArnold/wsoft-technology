<?php

declare(strict_types=1);

use App\Models\Accounts\Accounts;
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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)
                ->nullable();
            $table->foreignIdFor(User::class)
                ->nullable();
            $table->foreignIdFor(Person::class)
                ->nullable();
            $table->enum('type', ['receivables', 'payables'])->default('receivables');
            $table->integer('installment_number')->nullable();
            $table->decimal('amount', 10, 2);
            $table->integer('parcels')->nullable();
            $table->integer('days_to_pay')->default(10);
            $table->boolean('recurring')->default(false);
            $table->enum('status', ['pending', 'paid', 'overdue'])->default('pending');
            $table->enum('payment_method', ['card', 'cash', 'pix'])->default('pix');
            $table->date('due_date')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->string('attachment')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('category')->nullable();
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('interest_amount', 10, 2)->default(0);
            $table->decimal('fine_amount', 10, 2)->default(0);
            $table->text('payment_instructions')->nullable();
            $table->timestamps();
            $table->index(['tenant_id', 'user_id', 'person_id', 'type', 'status', 'due_date'], 'idx_accounts_composite');
        });

        Schema::create('accounts_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class);
            $table->foreignIdFor(Accounts::class);
            $table->integer('installment_number');
            $table->decimal('amount', 10, 2);
            $table->date('due_date');
            $table->boolean('status')->default(false);
            $table->dateTime('paid_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['tenant_id', 'accounts_id', 'installment_number', 'due_date', 'status'], 'idx_acct_inst_composite');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('accounts_installments');
    }
};
