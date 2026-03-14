<?php

namespace Database\Seeders;

use App\Models\Laboratory;
use Illuminate\Database\Seeder;

class LaboratorySeeder extends Seeder
{
    public function run(): void
    {
        $laboratories = [
            ['name' => 'Pfizer', 'address' => 'Av. Principal 123, Lima'],
            ['name' => 'Bayer', 'address' => 'Calle Comercio 456, Lima'],
            ['name' => 'Novartis', 'address' => 'Av. Industrial 789, Callao'],
            ['name' => 'Roche', 'address' => 'Jr. Farmacéutico 321, Lima'],
            ['name' => 'Johnson & Johnson', 'address' => 'Av. Las Américas 654, Lima'],
            ['name' => 'GlaxoSmithKline', 'address' => 'Calle Salud 987, Miraflores'],
            ['name' => 'Sanofi', 'address' => 'Av. Médica 147, San Isidro'],
            ['name' => 'Merck', 'address' => 'Jr. Ciencia 258, Lima'],
            ['name' => 'AbbVie', 'address' => 'Av. Tecnología 369, Surco'],
            ['name' => 'Bristol-Myers Squibb', 'address' => 'Calle Innovación 741, Lima'],
            ['name' => 'AstraZeneca', 'address' => 'Av. Biotecnología 852, La Molina'],
            ['name' => 'Eli Lilly', 'address' => 'Jr. Investigación 963, Lima'],
            ['name' => 'Boehringer Ingelheim', 'address' => 'Av. Desarrollo 159, San Borja'],
            ['name' => 'Takeda', 'address' => 'Calle Medicinal 357, Lima'],
            ['name' => 'Amgen', 'address' => 'Av. Biológica 468, Jesús María'],
        ];

        foreach ($laboratories as $laboratory) {
            Laboratory::create($laboratory);
        }
    }
}
