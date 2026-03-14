<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'ruc' => '20512345678',
                'name' => 'Distribuidora Farmacéutica del Norte',
                'address' => 'Av. Los Pinos 145, Trujillo',
                'phone' => '044-123456'
            ],
            [
                'ruc' => '20523456789',
                'name' => 'Droguería Central',
                'address' => 'Jr. Independencia 234, Lima',
                'phone' => '01-2345678'
            ],
            [
                'ruc' => '20534567890',
                'name' => 'Suministros Médicos ABC',
                'address' => 'Av. Arequipa 567, Lima',
                'phone' => '01-3456789'
            ],
            [
                'ruc' => '20545678901',
                'name' => 'Farmadistribuidora del Sur',
                'address' => 'Calle Mercaderes 890, Arequipa',
                'phone' => '054-234567'
            ],
            [
                'ruc' => '20556789012',
                'name' => 'Distribuidora Farma Express',
                'address' => 'Av. Industrial 321, Callao',
                'phone' => '01-4567890'
            ],
            [
                'ruc' => '20567890123',
                'name' => 'Medicamentos y Más',
                'address' => 'Jr. Comercio 654, Lima',
                'phone' => '01-5678901'
            ],
            [
                'ruc' => '20578901234',
                'name' => 'Drogas y Suministros S.A.',
                'address' => 'Av. Venezuela 987, Lima',
                'phone' => '01-6789012'
            ],
            [
                'ruc' => '20589012345',
                'name' => 'Farmacéutica Global',
                'address' => 'Calle Los Olivos 147, Chiclayo',
                'phone' => '074-345678'
            ],
            [
                'ruc' => '20590123456',
                'name' => 'Distribuidora Salud Total',
                'address' => 'Av. Túpac Amaru 258, Lima',
                'phone' => '01-7890123'
            ],
            [
                'ruc' => '20501234567',
                'name' => 'Importadora Médica Internacional',
                'address' => 'Jr. Tacna 369, Lima',
                'phone' => '01-8901234'
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
