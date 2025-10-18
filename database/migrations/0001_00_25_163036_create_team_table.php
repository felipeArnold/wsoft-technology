<?php

declare(strict_types=1);

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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('avatar')->nullable();
            $table->string('document', 14)->nullable();
            $table->string('website')->nullable();
            $table->enum('type', ['vehicle', 'other'])->default('other');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['name', 'slug', 'document']);
        });

        Schema::create('tenant_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)->index();
            $table->foreignIdFor(User::class)->index();
            $table->timestamps();
            $table->index(['tenant_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_user');
        Schema::dropIfExists('tenants');
    }
};
