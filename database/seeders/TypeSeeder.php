<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Antibiótico',
            'Analgésico',
            'Antiinflamatorio',
            'Antihipertensivo',
            'Antidiabético',
            'Vitaminas',
            'Suplementos',
            'Dermatológico',
            'Gastrointestinal',
            'Respiratorio',
            'Cardiovascular',
            'Antihistamínico',
            'Antiácido',
            'Mucolítico',
            'Antipirético',
        ];

        foreach ($types as $type) {
            Type::create(['name' => $type]);
        }
    }
}
