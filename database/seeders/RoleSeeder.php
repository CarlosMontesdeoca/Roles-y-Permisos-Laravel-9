<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 =Role::create(['name' => 'admin']);
        $role2 =Role::create(['name' => 'commertial']);
        $role1 =Role::create(['name' => 'application']);

        Permission::create(['name' => 'coo', 'action' => 'Crear pedidos para servicio técnico.']);
        Permission::create(['name' => 'doo', 'action' => 'Cancelar pedido para servicio técnico.']);
        Permission::create(['name' => 'dboo', 'action' => 'Descartar Balanzas de pedidos.']);
        Permission::create(['name' => 'ato', 'action' => 'Asignar tecnicos y fechas a pedidos.']);
        Permission::create(['name' => 'rmo', 'action' => 'Reenviar emails']);
        Permission::create(['name' => 'vro', 'action' => 'Ver repostes de trabajo.']);
        Permission::create(['name' => 'aro', 'action' => 'Analizar reportes de trabajo.']);
        Permission::create(['name' => 'nfo', 'action' => 'Notificación de facturación']);
        // Permission::create(['name' => 'Gestión de usuarios'])->syncRoles([$role2]);
    }
}
