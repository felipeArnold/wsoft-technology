<?php

declare(strict_types=1);

use App\Models\ServiceOrder;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Warranty;
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
        Schema::create('warranty_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Warranty::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ServiceOrder::class, 'resolution_service_order_id')->nullable()->constrained('service_orders')->nullOnDelete();
            $table->foreignIdFor(User::class, 'user_id')->comment('Usuário que registrou o acionamento')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'assigned_technician_id')->nullable()->comment('Técnico responsável')->constrained('users')->nullOnDelete();
            $table->foreignIdFor(User::class, 'approved_by_user_id')->nullable()->comment('Usuário que aprovou')->constrained('users')->nullOnDelete();

            $table->string('claim_number')->unique();
            $table->date('claim_date');
            $table->text('issue_description');
            $table->text('resolution_description')->nullable();
            $table->text('rejection_reason')->nullable()->comment('Motivo da rejeição, se aplicável');

            $table->enum('status', ['pending', 'approved', 'rejected', 'in_progress', 'completed'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->string('defect_type')->nullable()->comment('Tipo de defeito: elétrico, mecânico, etc');

            // Datas de controle
            $table->timestamp('approved_at')->nullable()->comment('Data de aprovação');
            $table->timestamp('started_at')->nullable()->comment('Data de início do atendimento');
            $table->timestamp('resolved_at')->nullable()->comment('Data de resolução');

            // Custos (caso haja custos adicionais não cobertos)
            $table->decimal('labor_cost', 10, 2)->default(0)->comment('Custo de mão de obra');
            $table->decimal('parts_cost', 10, 2)->default(0)->comment('Custo de peças');
            $table->decimal('additional_cost', 10, 2)->default(0)->comment('Custos adicionais');
            $table->boolean('covered_by_warranty')->default(true)->comment('Coberto pela garantia?');

            // Partes/itens relacionados
            $table->json('replaced_parts')->nullable()->comment('Peças substituídas');
            $table->json('attachments')->nullable()->comment('Fotos e documentos do acionamento');

            // Feedback
            $table->text('customer_feedback')->nullable()->comment('Feedback do cliente');
            $table->integer('customer_rating')->nullable()->comment('Avaliação do cliente (1-5)');

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['tenant_id', 'warranty_id', 'status']);
            $table->index(['claim_number']);
            $table->index(['status', 'priority']);
            $table->index(['assigned_technician_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warranty_claims');
    }
};
