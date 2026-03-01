<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = collect([
          'administrator',
          'seller'
        ]);

        $roles->each(fn ($role) => Role::create(['name' => $role]));
    }
}
