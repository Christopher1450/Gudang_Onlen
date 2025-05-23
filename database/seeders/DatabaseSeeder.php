<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama_id'  => 'superadmin_001',
            'name'     => 'Super Admin',
            'username' => 'superadmin',
            'password' => Hash::make('superpassword123'),
            'role'     => 'superadmin',
        ]);
    }
}
