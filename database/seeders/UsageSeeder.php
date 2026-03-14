<?php

namespace Database\Seeders;

use App\Models\Usage;
use Illuminate\Database\Seeder;

class UsageSeeder extends Seeder
{
    public function run(): void
    {
        $usages = [
            'Dolor de cabeza',
            'Fiebre',
            'Infecciones bacterianas',
            'Acidez estomacal',
            'Presión arterial alta',
            'Diabetes tipo 2',
            'Alergias',
            'Dolor muscular',
            'Tos y resfriado',
            'Colesterol alto',
            'Infecciones urinarias',
            'Problemas digestivos',
            'Dolor articular',
            'Infecciones de la piel',
            'Asma',
            'Deficiencia de vitaminas',
            'Anemia',
            'Problemas de tiroides',
            'Prevención cardiovascular',
            'Infecciones respiratorias',
        ];

        foreach ($usages as $usage) {
            Usage::create(['description' => $usage]);
        }
    }
}
