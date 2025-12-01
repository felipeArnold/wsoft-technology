<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_generations', function (Blueprint $table) {
            $table->id();

            // Relação com usuário
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            // Relação com o post (se aplicável)
            $table->foreignId('blog_post_id')->nullable()->constrained('blog_posts')->cascadeOnDelete();

            // Tipo de geração
            $table->enum('type', [
                'blog_post',
                'blog_post_improvement',
                'seo_metadata',
                'multiple_posts',
            ])->index();

            // Status da geração
            $table->enum('status', [
                'pending',
                'processing',
                'completed',
                'failed',
            ])->default('pending')->index();

            // Dados da requisição
            $table->text('prompt')->nullable();
            $table->json('request_data')->nullable();
            $table->string('model')->default('gpt-4o-mini');
            $table->float('temperature')->default(0.7);
            $table->integer('max_tokens')->default(3000);

            // Dados da resposta
            $table->longText('response_content')->nullable();
            $table->json('response_data')->nullable();

            // Métricas e custos
            $table->integer('tokens_used')->nullable();
            $table->integer('prompt_tokens')->nullable();
            $table->integer('completion_tokens')->nullable();
            $table->decimal('estimated_cost', 10, 6)->nullable();
            $table->integer('processing_time_ms')->nullable();

            // Informações de retry
            $table->integer('retry_attempts')->default(0);
            $table->text('error_message')->nullable();

            // Metadados
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            // Índices
            $table->index('created_at');
            $table->index(['user_id', 'type']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_generations');
    }
};
