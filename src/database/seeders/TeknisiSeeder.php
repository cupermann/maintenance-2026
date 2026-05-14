<?php

namespace Database\Seeders;

use App\Models\Teknisi;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeknisiSeeder extends Seeder
{
    public function run(): void
    {
        $Teknisi = User::query()
            ->where('email', 'teknisi@admin.com')
            ->first();

        if (! $Teknisi) {
            return;
        }

        Teknisi::query()->updateOrCreate(
            ['user_id' => $Teknisi->id],
            [
                'kode_teknisi' => 'TKN-001',
                'nama_teknisi' => 'Teknisi Maintenance',
                'no_telepon' => '082222222222',
                'keahlian' => 'Maintenance Gedung',
                'status' => 'aktif',
                'alamat' => 'Area Kampus Utama',
            ]
        );
    }
}