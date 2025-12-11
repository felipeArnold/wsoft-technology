<?php

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
        Schema::table('accounts', function (Blueprint $table) {
            $table->enum('payment_method', [
                'cash',
                'card',
                'pix',
                'bank_transfer',
                'check',
                'boleto',
                'debit_card',
                'credit_card'
            ])->default('pix')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->enum('payment_method', ['card', 'cash', 'pix'])->default('pix')->change();
        });
    }
};
