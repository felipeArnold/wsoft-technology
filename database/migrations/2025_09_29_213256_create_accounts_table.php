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
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->string('attachment')->nullable();
            $table->string('reference_number')->nullable()->after('notes');
            $table->string('category')->nullable()->after('reference_number');
            $table->decimal('discount_amount', 10, 2)->default(0)->after('category');
            $table->decimal('interest_amount', 10, 2)->default(0)->after('discount_amount');
            $table->decimal('fine_amount', 10, 2)->default(0)->after('interest_amount');
            $table->text('payment_instructions')->nullable()->after('fine_amount');
            $table->timestamps();
            $table->index(['tenant_id', 'user_id', 'person_id', 'type', 'status', 'due_date']);
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
            $table->index(['tenant_id', 'account_id', 'installment_number', 'due_date', 'status']);
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
