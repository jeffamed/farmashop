<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            'Estante A1',
            'Estante A2',
            'Estante A3',
            'Estante B1',
            'Estante B2',
            'Estante B3',
            'Estante C1',
            'Estante C2',
            'Estante C3',
            'Refrigerador 1',
            'Refrigerador 2',
            'Almacén Principal',
            'Almacén Secundario',
            'Área de Recepción',
            'Exhibidor Principal',
        ];

        foreach ($locations as $location) {
            Location::create(['name' => $location]);
        }
    }
}
