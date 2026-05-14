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
        Schema::create('progres_perbaikans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('permintaan_maintenance_id')
                ->constrained('permintaan_maintenances')
                ->cascadeOnDelete();
            $table->foreignId('teknisi_id')
                ->constrained('teknisis')
                ->cascadeOnDelete();
            $table->enum('status_progres', [
                'mulai_dikerjakan',
                'sedang_dikerjakan',
                'selesai',
            ]);
            $table->text('deskripsi_progres');
            $table->string('foto_progres')->nullable();
            $table->timestamp('tanggal_progres')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres_perbaikans');
    }
};
