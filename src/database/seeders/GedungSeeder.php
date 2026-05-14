<?php

namespace Database\Seeders;

use App\Models\Gedung;
use Illuminate\Database\Seeder;

class GedungSeeder extends Seeder
{
    public function run(): void
    {
        Gedung::query()->updateOrCreate(
            ['kode_gedung' => 'GD-A'],
            [
                'nama_gedung' => 'Gedung A',
                'alamat' => 'Area Kampus Utama',
                'keterangan' => 'Gedung perkuliahan utama.',
            ]
        );

        Gedung::query()->updateOrCreate(
            ['kode_gedung' => 'GD-B'],
            [
                'nama_gedung' => 'Gedung B',
                'alamat' => 'Area Kampus Utama',
                'keterangan' => 'Gedung laboratorium dan administrasi.',
            ]
        );

        Gedung::query()->updateOrCreate(
            ['kode_gedung' => 'GD-C'],
            [
                'nama_gedung' => 'Gedung C',
                'alamat' => 'Area Kampus Utama',
                'keterangan' => 'Gedung kegiatan mahasiswa.',
            ]
        );
    }
}