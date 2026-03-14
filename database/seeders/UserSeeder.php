<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super',
            'last_name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin1234'),
            'document' => '123456789',
            //'role_id' => 1
        ]);
    }
}
