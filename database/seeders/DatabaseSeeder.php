<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            PermissionsSeeder::class,
            UserSeeder::class,
            LaboratorySeeder::class,
            TypeSeeder::class,
            LocationSeeder::class,
            SupplierSeeder::class,
            PresentationSeeder::class,
            UsageSeeder::class,
            CustomerSeeder::class,
            ProductSeeder::class,
            ProductUsageSeeder::class,
            OrderSeeder::class,
            SaleSeeder::class,
        ]);
    }
}
