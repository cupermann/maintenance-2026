<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TeknisiSeeder::class,
            GedungSeeder::class,
            RuanganSeeder::class,
            KategoriKerusakanSeeder::class,
            PermintaanMaintenanceSeeder::class,
            PenugasanTeknisiSeeder::class,
            ProgresPerbaikanSeeder::class,
        ]);
    }
}