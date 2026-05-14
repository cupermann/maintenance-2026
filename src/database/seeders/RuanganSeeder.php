<?php

namespace Database\Seeders;

use App\Models\Gedung;
use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $gedungA = Gedung::query()->where('kode_gedung', 'GD-A')->first();
        $gedungB = Gedung::query()->where('kode_gedung', 'GD-B')->first();
        $gedungC = Gedung::query()->where('kode_gedung', 'GD-C')->first();

        if ($gedungA) {
            Ruangan::query()->updateOrCreate(
                ['kode_ruangan' => 'A-101'],
                [
                    'gedung_id' => $gedungA->id,
                    'nama_ruangan' => 'Ruang A 101',
                    'lantai' => '1',
                    'keterangan' => 'Ruang kelas.',
                ]
            );

            Ruangan::query()->updateOrCreate(
                ['kode_ruangan' => 'A-102'],
                [
                    'gedung_id' => $gedungA->id,
                    'nama_ruangan' => 'Ruang A 102',
                    'lantai' => '1',
                    'keterangan' => 'Ruang kelas.',
                ]
            );

            Ruangan::query()->updateOrCreate(
                ['kode_ruangan' => 'TOILET-A1'],
                [
                    'gedung_id' => $gedungA->id,
                    'nama_ruangan' => 'Toilet Gedung A',
                    'lantai' => '1',
                    'keterangan' => 'Toilet umum Gedung A.',
                ]
            );
        }

        if ($gedungB) {
            Ruangan::query()->updateOrCreate(
                ['kode_ruangan' => 'B-201'],
                [
                    'gedung_id' => $gedungB->id,
                    'nama_ruangan' => 'Ruang B 201',
                    'lantai' => '2',
                    'keterangan' => 'Ruang laboratorium.',
                ]
            );

            Ruangan::query()->updateOrCreate(
                ['kode_ruangan' => 'B-202'],
                [
                    'gedung_id' => $gedungB->id,
                    'nama_ruangan' => 'Ruang B 202',
                    'lantai' => '2',
                    'keterangan' => 'Ruang administrasi.',
                ]
            );

            Ruangan::query()->updateOrCreate(
                ['kode_ruangan' => 'TOILET-B1'],
                [
                    'gedung_id' => $gedungB->id,
                    'nama_ruangan' => 'Toilet Gedung B',
                    'lantai' => '2',
                    'keterangan' => 'Toilet umum Gedung B.',
                ]
            );
        }

        if ($gedungC) {
            Ruangan::query()->updateOrCreate(
                ['kode_ruangan' => 'C-301'],
                [
                    'gedung_id' => $gedungC->id,
                    'nama_ruangan' => 'Ruang C 301',
                    'lantai' => '3',
                    'keterangan' => 'Ruang kegiatan mahasiswa.',
                ]
            );
        }
    }
}