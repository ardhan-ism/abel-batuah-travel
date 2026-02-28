<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@abelbatuah.test'],
            [
                'name' => 'Admin Abel Batuah',
                'phone_wa' => '6281234567890',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
            ]
        );
    }
}