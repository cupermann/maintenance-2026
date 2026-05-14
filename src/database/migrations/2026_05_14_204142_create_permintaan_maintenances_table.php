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
        Schema::create('permintaan_maintenances', function (Blueprint $table) {
            $table->id();

            $table->string('kode_permintaan')->unique();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('ruangan_id')
                ->constrained('ruangans')
                ->cascadeOnDelete();

            $table->foreignId('kategori_kerusakan_id')
                ->constrained('kategori_kerusakans')
                ->cascadeOnDelete();

            $table->string('judul');
            $table->text('deskripsi');
            $table->string('foto_kerusakan')->nullable();

            $table->enum('prioritas', [
                'rendah',
                'sedang',
                'tinggi',
                'darurat',
            ])->default('sedang');

            $table->enum('status', [
                'diajukan',
                'diverifikasi',
                'ditolak',
                'ditugaskan',
                'diproses',
                'selesai',
            ])->default('diajukan');

            $table->text('catatan_admin')->nullable();
            $table->timestamp('tanggal_laporan')->nullable();
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_maintenances');
    }
};
