<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permintaan_maintenances', function (Blueprint $table) {
            try {
                $table->dropForeign(['user_id']);
            } catch (\Throwable $e) {
                //
            }
        });

        Schema::table('permintaan_maintenances', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();

            if (! Schema::hasColumn('permintaan_maintenances', 'nama_pelapor')) {
                $table->string('nama_pelapor')->nullable()->after('user_id');
            }

            if (! Schema::hasColumn('permintaan_maintenances', 'email_pelapor')) {
                $table->string('email_pelapor')->nullable()->after('nama_pelapor');
            }

            if (! Schema::hasColumn('permintaan_maintenances', 'no_telepon_pelapor')) {
                $table->string('no_telepon_pelapor')->nullable()->after('email_pelapor');
            }

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('permintaan_maintenances', function (Blueprint $table) {
            try {
                $table->dropForeign(['user_id']);
            } catch (\Throwable $e) {
                //
            }

            if (Schema::hasColumn('permintaan_maintenances', 'nama_pelapor')) {
                $table->dropColumn('nama_pelapor');
            }

            if (Schema::hasColumn('permintaan_maintenances', 'email_pelapor')) {
                $table->dropColumn('email_pelapor');
            }

            if (Schema::hasColumn('permintaan_maintenances', 'no_telepon_pelapor')) {
                $table->dropColumn('no_telepon_pelapor');
            }
        });
    }
};