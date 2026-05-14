<?php

namespace Database\Seeders;

use App\Models\KategoriKerusakan;
use Illuminate\Database\Seeder;

class KategoriKerusakanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_kategori' => 'Listrik',
                'deskripsi' => 'Kerusakan lampu, stop kontak, saklar, dan instalasi listrik.',
            ],
            [
                'nama_kategori' => 'AC',
                'deskripsi' => 'Kerusakan pendingin ruangan atau AC tidak berfungsi.',
            ],
            [
                'nama_kategori' => 'Bangunan',
                'deskripsi' => 'Kerusakan plafon, lantai, dinding, pintu, dan jendela.',
            ],
            [
                'nama_kategori' => 'Air dan Sanitasi',
                'deskripsi' => 'Kerusakan toilet, wastafel, saluran air, dan kebocoran.',
            ],
            [
                'nama_kategori' => 'Fasilitas Ruangan',
                'deskripsi' => 'Kerusakan meja, kursi, papan tulis, proyektor, dan fasilitas kelas.',
            ],
        ];

        foreach ($data as $item) {
            KategoriKerusakan::query()->firstOrCreate(
                ['nama_kategori' => $item['nama_kategori']],
                ['deskripsi' => $item['deskripsi']]
            );
        }
    }
}