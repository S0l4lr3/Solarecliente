<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'nombre' => 'Administrador',
                'descripcion' => 'Acceso total al sistema',
                'creado_en' => now(),
                'actualizado_en' => now()
            ],
            [
                'nombre' => 'Vendedor',
                'descripcion' => 'Puede gestionar ventas y clientes',
                'creado_en' => now(),
                'actualizado_en' => now()
            ],
            [
                'nombre' => 'Cliente',
                'descripcion' => 'Usuario final que compra productos',
                'creado_en' => now(),
                'actualizado_en' => now()
            ]
        ]);
    }
}