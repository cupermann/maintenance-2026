<?php

namespace Database\Seeders;

use App\Models\PenugasanTeknisi;
use App\Models\PermintaanMaintenance;
use App\Models\Teknisi;
use App\Models\User;
use Illuminate\Database\Seeder;

class PenugasanTeknisiSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()
            ->where('email', 'admin@kampus.test')
            ->first();

        $teknisi = Teknisi::query()
            ->where('kode_teknisi', 'TKN-001')
            ->first();

        $permintaan = PermintaanMaintenance::query()
            ->where('kode_permintaan', 'PM-003')
            ->first();

        if (! $admin || ! $teknisi || ! $permintaan) {
            return;
        }

        PenugasanTeknisi::query()->updateOrCreate(
            ['permintaan_maintenance_id' => $permintaan->id],
            [
                'teknisi_id' => $teknisi->id,
                'admin_id' => $admin->id,
                'tanggal_penugasan' => now(),
                'catatan_penugasan' => 'Teknisi ditugaskan untuk memeriksa dan memperbaiki pintu ruangan.',
            ]
        );

        $permintaan->update([
            'status' => 'ditugaskan',
        ]);
    }
}