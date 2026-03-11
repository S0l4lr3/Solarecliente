<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->insert([
            'nombre' => 'Admin',
            'apellido_paterno' => 'Sistema',
            'apellido_materno' => null,
            'correo' => 'admin@solare.com',
            'contrasena' => Hash::make('admin123'),
            'rol_id' => 1, // Administrador
            'correo_verificado_en' => now(),
            'creado_en' => now(),
            'actualizado_en' => now()
        ]);
    }
}