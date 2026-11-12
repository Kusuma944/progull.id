<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@progull.id'],
            [
                'name' => 'Admin Progull',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@progull.id'],
            [
                'name' => 'Customer Test',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
            ]
        );
    }
}
