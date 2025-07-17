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
        Schema::table('budgets', function (Blueprint $table) {
            $table->decimal('total_budget', 20, 2)->change();
            $table->decimal('terpakai', 20, 2)->change();
            $table->decimal('tersisa', 20, 2)->change();
        });
        Schema::table('permintaan', function (Blueprint $table) {
            $table->decimal('total_estimasi', 20, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->decimal('total_budget', 15, 2)->change();
            $table->decimal('terpakai', 15, 2)->change();
            $table->decimal('tersisa', 15, 2)->change();
        });
        Schema::table('permintaan', function (Blueprint $table) {
            $table->decimal('total_estimasi', 15, 2)->change();
        });
    }
}; 