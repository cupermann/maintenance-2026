<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'superadmin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'phone' => '080000000000',
                'role' => 'super_admin',
            ]
        );
        $user->syncRoles(['super_admin']);

        $user = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin Maintenance',
                'password' => Hash::make('password'),
                'phone' => '081111111111',
                'role' => 'admin',
            ]
        );
        $user->syncRoles(['admin']);

        $user = User::updateOrCreate(
            ['email' => 'teknisi@admin.com'],
            [
                'name' => 'Teknisi Maintenance',
                'password' => Hash::make('password'),
                'phone' => '082222222222',
                'role' => 'teknisi',
            ]
        );
        $user->syncRoles(['teknisi']);

        $user = User::updateOrCreate(
            ['email' => 'user@admin.com'],
            [
                'name' => 'User Account',
                'password' => Hash::make('password'),
                'phone' => '083333333333',
                'role' => 'user',
            ]
        );
        $user->syncRoles(['user']);
    }
}