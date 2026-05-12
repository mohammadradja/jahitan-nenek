<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(['email' => 'admin@jahitannenek.com'], [
            'name' => 'Admin Nenek',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::firstOrCreate(['email' => 'super@jahitannenek.com'], [
            'name' => 'Super Admin',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);

        User::firstOrCreate(['email' => 'customer@example.com'], [
            'name' => 'Customer Happy',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
