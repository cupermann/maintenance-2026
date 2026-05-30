<?php

namespace Database\Seeders;

use App\Models\Teknisi;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeknisiSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()
            ->where('role', 'teknisi')
            ->first();

        if (! $user) {
            return;
        }

        Teknisi::query()->updateOrCreate(
            [
                'kode_teknisi' => 'TKN-001',
            ],
            [
                'user_id' => $user->id,
                'nama_teknisi' => $user->name,
                'no_telepon' => $user->phone,
                'keahlian' => 'Maintenance Gedung',
                'status' => 'aktif',
                'alamat' => 'Kampus',
            ]
        );
    }
}