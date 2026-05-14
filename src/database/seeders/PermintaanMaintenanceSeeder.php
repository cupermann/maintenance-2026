<?php

namespace Database\Seeders;

use App\Models\KategoriKerusakan;
use App\Models\PermintaanMaintenance;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermintaanMaintenanceSeeder extends Seeder
{
    public function run(): void
    {
        $pelapor = User::query()
            ->where('email', 'user@kampus.test')
            ->first();

        $ruanganA101 = Ruangan::query()
            ->where('kode_ruangan', 'A-101')
            ->first();

        $ruanganB201 = Ruangan::query()
            ->where('kode_ruangan', 'B-201')
            ->first();

        $ruanganC301 = Ruangan::query()
            ->where('kode_ruangan', 'C-301')
            ->first();

        $kategoriAC = KategoriKerusakan::query()
            ->where('nama_kategori', 'AC')
            ->first();

        $kategoriListrik = KategoriKerusakan::query()
            ->where('nama_kategori', 'Listrik')
            ->first();

        $kategoriBangunan = KategoriKerusakan::query()
            ->where('nama_kategori', 'Bangunan')
            ->first();

        if ($pelapor && $ruanganA101 && $kategoriAC) {
            PermintaanMaintenance::query()->updateOrCreate(
                ['kode_permintaan' => 'PM-001'],
                [
                    'user_id' => $pelapor->id,
                    'ruangan_id' => $ruanganA101->id,
                    'kategori_kerusakan_id' => $kategoriAC->id,
                    'judul' => 'AC tidak dingin',
                    'deskripsi' => 'AC di ruang A 101 menyala tetapi tidak mengeluarkan udara dingin.',
                    'foto_kerusakan' => null,
                    'prioritas' => 'sedang',
                    'status' => 'diajukan',
                    'catatan_admin' => null,
                    'tanggal_laporan' => now()->subDays(3),
                    'tanggal_verifikasi' => null,
                    'tanggal_selesai' => null,
                ]
            );
        }

        if ($pelapor && $ruanganB201 && $kategoriListrik) {
            PermintaanMaintenance::query()->updateOrCreate(
                ['kode_permintaan' => 'PM-002'],
                [
                    'user_id' => $pelapor->id,
                    'ruangan_id' => $ruanganB201->id,
                    'kategori_kerusakan_id' => $kategoriListrik->id,
                    'judul' => 'Lampu ruangan mati',
                    'deskripsi' => 'Lampu utama di ruang B 201 tidak menyala.',
                    'foto_kerusakan' => null,
                    'prioritas' => 'tinggi',
                    'status' => 'diverifikasi',
                    'catatan_admin' => 'Laporan valid dan perlu ditindaklanjuti.',
                    'tanggal_laporan' => now()->subDays(2),
                    'tanggal_verifikasi' => now()->subDay(),
                    'tanggal_selesai' => null,
                ]
            );
        }

        if ($pelapor && $ruanganC301 && $kategoriBangunan) {
            PermintaanMaintenance::query()->updateOrCreate(
                ['kode_permintaan' => 'PM-003'],
                [
                    'user_id' => $pelapor->id,
                    'ruangan_id' => $ruanganC301->id,
                    'kategori_kerusakan_id' => $kategoriBangunan->id,
                    'judul' => 'Pintu ruangan rusak',
                    'deskripsi' => 'Engsel pintu ruang C 301 rusak dan sulit ditutup.',
                    'foto_kerusakan' => null,
                    'prioritas' => 'sedang',
                    'status' => 'diverifikasi',
                    'catatan_admin' => 'Perlu penanganan teknisi.',
                    'tanggal_laporan' => now()->subDay(),
                    'tanggal_verifikasi' => now(),
                    'tanggal_selesai' => null,
                ]
            );
        }
    }
}