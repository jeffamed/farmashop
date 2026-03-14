<?php

namespace Database\Seeders;

use App\Models\Presentation;
use Illuminate\Database\Seeder;

class PresentationSeeder extends Seeder
{
    public function run(): void
    {
        $presentations = [
            'Tabletas',
            'Cápsulas',
            'Jarabe',
            'Suspensión',
            'Crema',
            'Gel',
            'Pomada',
            'Solución inyectable',
            'Ampolla',
            'Gotas',
            'Spray',
            'Supositorio',
            'Parche',
            'Polvo',
            'Óvulo',
        ];

        foreach ($presentations as $presentation) {
            Presentation::create(['name' => $presentation]);
        }
    }
}
