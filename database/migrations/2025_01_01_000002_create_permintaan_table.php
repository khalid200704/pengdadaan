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
        Schema::create('permintaan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_permintaan')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul_permintaan');
            $table->text('deskripsi');
            $table->decimal('total_estimasi', 15, 2);
            $table->enum('status', ['menunggu_persetujuan', 'disetujui', 'ditolak'])->default('menunggu_persetujuan');
            $table->text('keterangan')->nullable();
            $table->text('catatan_approver')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('tanggal_permintaan')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan');
    }
}; 