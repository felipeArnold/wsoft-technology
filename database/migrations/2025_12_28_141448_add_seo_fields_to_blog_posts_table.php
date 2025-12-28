<?php

declare(strict_types=1);

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
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->text('featured_snippet')->nullable()->after('meta_description');
            $table->json('ai_summary')->nullable()->after('featured_snippet');
            $table->json('faq')->nullable()->after('ai_summary');
            $table->text('discover_context')->nullable()->after('faq');
            $table->text('discover_image_prompt')->nullable()->after('discover_context');
            $table->json('internal_links_suggestions')->nullable()->after('discover_image_prompt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn([
                'featured_snippet',
                'ai_summary',
                'faq',
                'discover_context',
                'discover_image_prompt',
                'internal_links_suggestions',
            ]);
        });
    }
};
