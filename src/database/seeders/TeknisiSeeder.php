<?php

namespace Database\Seeders;

use App\Models\Teknisi;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeknisiSeeder extends Seeder
{
    public function run(): void
    {
        $userTeknisi = User::query()
            ->where('email', 'teknisi@admin.com')
            ->first();

        if (! $userTeknisi) {
            return;
        }

        Teknisi::query()->updateOrCreate(
            ['user_id' => $userTeknisi->id],
            [
                'nama_teknisi' => 'Teknisi Maintenance',
                'keahlian' => 'General Maintenance',
                'no_telepon' => '082222222222',
                'status' => 'aktif',
            ]
        );
    }
}