<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = collect([
            [
                'name' => 'customer',
                'label' => 'Cliente'
            ],
            [
                'name' => 'customer.create',
                'label' => 'Crear Cliente'

            ],
            [
                'name' => 'customer.update',
                'label' => 'Actualizar Cliente'

            ],
            [
                'name' => 'customer.delete',
                'label' => 'Eliminar Cliente'
            ],
            [
                'name' => 'laboratory',
                'label' => 'Laboratorio'
            ],
            [
                'name' => 'laboratory.create',
                'label' => 'Crear Laboratorio'
            ],
            [
                'name' => 'laboratory.update',
                'label' => 'Actualizar Laboratorio'
            ],
            [
                'name' => 'laboratory.delete',
                'label' => 'Eliminar Laboratorio'
            ],
            [
                'name' => 'location',
                'label' => 'Ubicacion'
            ],
            [
                'name' => 'location.create',
                'label' => 'Crear Ubicacion'
            ],
            [
                'name' => 'location.update',
                'label' => 'Actualizar Ubicacion'
            ],
            [
                'name' => 'location.delete',
                'label' => 'Eliminar Ubicacion'
            ],
            [
                'name' => 'order',
                'label' => 'Compras',
            ],
            [
                'name' => 'order.create',
                'label' => 'Crear Compras',
            ],
            [
                'name' => 'order.delete',
                'label' => 'Eliminar Compras',
            ],
            [
                'name' => 'presentation',
                'label' => 'Presentacion',
            ],
            [
                'name' => 'presentation.create',
                'label' => 'Crear Presentacion',
            ],
            [
                'name' => 'presentation.update',
                'label' => 'Actualizar Presentacion',
            ],
            [
                'name' => 'presentation.delete',
                'label' => 'Eliminar Presentacion',
            ],
            [
                'name' => 'product',
                'label' => 'Producto',
            ],
            [
                'name' => 'product.create',
                'label' => 'Crear Producto',
            ],
            [
                'name' => 'product.update',
                'label' => 'Actualizar Producto',
            ],
            [
                'name' => 'product.delete',
                'label' => 'Eliminar Producto',
            ],
            [
                'name' => 'sale',
                'label' => 'Ventas',
            ],
            [
                'name' => 'sale.create',
                'label' => 'Crear Ventas',
            ],
            [
                'name' => 'sale.create',
                'label' => 'Crear Ventas',
            ],
            [
                'name' => 'sale.delete',
                'label' => 'Eliminar Ventas',
            ],
            [
                'name' => 'supplier',
                'label' => 'Proveedor',
            ],
            [
                'name' => 'supplier.create',
                'label' => 'Crear Proveedor',
            ],
            [
                'name' => 'supplier.update',
                'label' => 'Actualizar Proveedor',
            ],
            [
                'name' => 'supplier.delete',
                'label' => 'Eliminar Proveedor',
            ],
            [
                'name' => 'type',
                'label' => 'Tipo de Prod.',
            ],
            [
                'name' => 'type.create',
                'label' => 'Crear Tipo de Prod.',
            ],
            [
                'name' => 'type.update',
                'label' => 'Actualizar Tipo de Prod.',
            ],
            [
                'name' => 'type.delete',
                'label' => 'Eliminar Tipo de Prod.',
            ],
            [
                'name' => 'usage',
                'label' => 'Uso',
            ],
            [
                'name' => 'usage.create',
                'label' => 'Crear Uso',
            ],
            [
                'name' => 'usage.update',
                'label' => 'Actualizar Uso',
            ],
            [
                'name' => 'usage.delete',
                'label' => 'Eliminar Uso'
            ],
            [
                'name' => 'user',
                'label' => 'Usuario',
            ],
            [
                'name' => 'user.create',
                'label' => 'Crear Usuario',
            ],
            [
                'name' => 'user.update',
                'label' => 'Actualizar Usuario',
            ],
            [
                'name' => 'user.delete',
                'label' => 'Eliminar Usuario',
            ],
            [
                'name' => 'role',
                'label' => 'Roles',
            ],
            [
                'name' => 'role.create',
                'label' => 'Crear Roles',
            ],
            [
                'name' => 'role.update',
                'label' => 'Actualizar Roles',
            ],
            [
                'name' => 'role.delete',
                'label' => 'Eliminar Roles',
            ],
            [
                'name' => 'product.bonus',
                'label' => 'Agregar Bonificación',
            ],
            [
                'name' => 'reimbursement',
                'label' => 'Devoluciones',
            ],
            [
                'name' => 'reimbursement.create',
                'label' => 'Crear Devolución',
            ],
            [
                'name' => 'reimbursement.delete',
                'label' => 'Eliminar Devolución',
            ]
        ]);
        $adminRole = Role::where('name', 'administrator')->first();
        $permissions->each(function ($permission) use ($adminRole) {
            $permission = Permission::create($permission);
            $adminRole->givePermissionTo($permission);
        });
    }
}
