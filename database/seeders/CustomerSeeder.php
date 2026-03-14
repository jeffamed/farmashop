<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['dni' => '12345678', 'name' => 'Juan', 'last_name' => 'Pérez García', 'address' => 'Av. Los Robles 123, Lima', 'phone' => '987654321', 'email' => 'juan.perez@example.com'],
            ['dni' => '23456789', 'name' => 'María', 'last_name' => 'López Sánchez', 'address' => 'Jr. Las Flores 456, Callao', 'phone' => '976543210', 'email' => 'maria.lopez@example.com'],
            ['dni' => '34567890', 'name' => 'Carlos', 'last_name' => 'Rodríguez Mendoza', 'address' => 'Calle Principal 789, Lima', 'phone' => '965432109', 'email' => 'carlos.rodriguez@example.com'],
            ['dni' => '45678901', 'name' => 'Ana', 'last_name' => 'Martínez Torres', 'address' => 'Av. Central 321, Surco', 'phone' => '954321098', 'email' => 'ana.martinez@example.com'],
            ['dni' => '56789012', 'name' => 'Luis', 'last_name' => 'García Fernández', 'address' => 'Jr. Comercio 654, Lima', 'phone' => '943210987', 'email' => 'luis.garcia@example.com'],
            ['dni' => '67890123', 'name' => 'Rosa', 'last_name' => 'Hernández Vega', 'address' => 'Av. Universitaria 987, Los Olivos', 'phone' => '932109876', 'email' => 'rosa.hernandez@example.com'],
            ['dni' => '78901234', 'name' => 'Pedro', 'last_name' => 'González Ramírez', 'address' => 'Calle Lima 147, Miraflores', 'phone' => '921098765', 'email' => 'pedro.gonzalez@example.com'],
            ['dni' => '89012345', 'name' => 'Carmen', 'last_name' => 'Díaz Castro', 'address' => 'Jr. Unión 258, San Isidro', 'phone' => '910987654', 'email' => 'carmen.diaz@example.com'],
            ['dni' => '90123456', 'name' => 'Miguel', 'last_name' => 'Vargas Silva', 'address' => 'Av. Arequipa 369, Lince', 'phone' => '909876543', 'email' => 'miguel.vargas@example.com'],
            ['dni' => '01234567', 'name' => 'Laura', 'last_name' => 'Ruiz Morales', 'address' => 'Calle San Martín 741, La Molina', 'phone' => '998765432', 'email' => 'laura.ruiz@example.com'],
            ['dni' => '11111111', 'name' => 'Jorge', 'last_name' => 'Flores Quispe', 'address' => 'Av. Javier Prado 852, San Borja', 'phone' => '987654322', 'email' => 'jorge.flores@example.com'],
            ['dni' => '22222222', 'name' => 'Elena', 'last_name' => 'Castro Rojas', 'address' => 'Jr. Libertad 963, Jesús María', 'phone' => '976543211', 'email' => 'elena.castro@example.com'],
            ['dni' => '33333333', 'name' => 'Roberto', 'last_name' => 'Mendoza Chávez', 'address' => 'Calle Bolívar 159, Pueblo Libre', 'phone' => '965432110', 'email' => 'roberto.mendoza@example.com'],
            ['dni' => '44444444', 'name' => 'Patricia', 'last_name' => 'Torres Paredes', 'address' => 'Av. Venezuela 357, Breña', 'phone' => '954321099', 'email' => 'patricia.torres@example.com'],
            ['dni' => '55555555', 'name' => 'Fernando', 'last_name' => 'Ramos Huamán', 'address' => 'Jr. Tacna 468, Cercado de Lima', 'phone' => '943210988', 'email' => 'fernando.ramos@example.com'],
            ['dni' => '66666666', 'name' => 'Sofía', 'last_name' => 'Gutiérrez Salazar', 'address' => 'Av. Colonial 579, Callao', 'phone' => '932109877', 'email' => 'sofia.gutierrez@example.com'],
            ['dni' => '77777777', 'name' => 'Ricardo', 'last_name' => 'Jiménez Campos', 'address' => 'Calle Real 681, Magdalena', 'phone' => '921098766', 'email' => 'ricardo.jimenez@example.com'],
            ['dni' => '88888888', 'name' => 'Gabriela', 'last_name' => 'Romero Cruz', 'address' => 'Jr. Ayacucho 792, San Miguel', 'phone' => '910987655', 'email' => 'gabriela.romero@example.com'],
            ['dni' => '99999999', 'name' => 'Daniel', 'last_name' => 'Medina Espinoza', 'address' => 'Av. La Marina 803, San Miguel', 'phone' => '909876544', 'email' => 'daniel.medina@example.com'],
            ['dni' => '10101010', 'name' => 'Lucía', 'last_name' => 'Navarro Ortiz', 'address' => 'Calle Grau 914, Barranco', 'phone' => '998765433', 'email' => 'lucia.navarro@example.com'],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
