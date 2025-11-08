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
        Schema::table('envelopes', function (Blueprint $table) {
            $table->string('zapsign_token')->nullable()->after('status');
            $table->integer('zapsign_open_id')->nullable()->after('zapsign_token');
            $table->string('zapsign_status')->nullable()->after('zapsign_open_id');
            $table->text('zapsign_url')->nullable()->after('zapsign_status');
            $table->text('zapsign_signed_file')->nullable()->after('zapsign_url');
            $table->timestamp('zapsign_sent_at')->nullable()->after('zapsign_signed_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('envelopes', function (Blueprint $table) {
            $table->dropColumn([
                'zapsign_token',
                'zapsign_open_id',
                'zapsign_status',
                'zapsign_url',
                'zapsign_signed_file',
                'zapsign_sent_at',
            ]);
        });
    }
};
