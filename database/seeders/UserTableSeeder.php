<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserTableSeeder extends Seeder
{
    /** Si es necesario crear nuevamente usuarios en el sistema de 0 con un administrador general se corre esta migracion */
    public function run()
    {
        User::truncate();
        $faker = \Faker\Factory::create();
        
        $password = Hash::make('AdminSistemas@');
        User::create([
            'nom' => 'ADMINISTRADOR', 
            'usr' => 'admin', 
            'email' => 'laboratorio@precitrol.com', 
            'password' => $password, 
            'carg' => 'ADMINISTRADOR',
        ])->assignRole('admin');

        User::create([
            'nom' => 'KALKUMOTORO', 
            'usr' => 'metrologiaSrv', 
            'email' => 'motoro@precitrol.local', 
            'password' => Hash::make('SistemaMetrologia@@'), 
            'carg' => 'SERVIDOR',
        ])->assignRole('application');

        User::create([
            'nom' => 'SEVIDOR AUXILIAR', 
            'usr' => 'metrologiaSrv2', 
            'email' => 'ser.aux@precitrol.local', 
            'password' => Hash::make('SistemaMetrologia@@'), 
            'carg' => 'SERVIDOR',
        ])->assignRole('application');
    }
}