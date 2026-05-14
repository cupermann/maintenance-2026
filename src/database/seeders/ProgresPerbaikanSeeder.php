<?php

namespace Database\Seeders;

use App\Models\ProgresPerbaikan;
use App\Models\PermintaanMaintenance;
use App\Models\Teknisi;
use Illuminate\Database\Seeder;

class ProgresPerbaikanSeeder extends Seeder
{
    public function run(): void
    {
        $teknisi = Teknisi::query()
            ->where('kode_teknisi', 'TKN-001')
            ->first();

        $permintaan = PermintaanMaintenance::query()
            ->where('kode_permintaan', 'PM-003')
            ->first();

        if (! $teknisi || ! $permintaan) {
            return;
        }

        ProgresPerbaikan::query()->updateOrCreate(
            [
                'permintaan_maintenance_id' => $permintaan->id,
                'status_progres' => 'mulai_dikerjakan',
            ],
            [
                'teknisi_id' => $teknisi->id,
                'deskripsi_progres' => 'Teknisi sudah menerima tugas dan mulai melakukan pengecekan kerusakan.',
                'foto_progres' => null,
                'tanggal_progres' => now(),
            ]
        );

        $permintaan->update([
            'status' => 'diproses',
        ]);
    }
}