<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100)->nullable();
            $table->string('correo', 100)->unique();
            $table->string('contrasena', 255);
            $table->foreignId('rol_id')->constrained('roles');
            $table->string('token_recuerdo', 100)->nullable();
            $table->datetime('correo_verificado_en')->nullable();
            $table->datetime('creado_en')->useCurrent();
            $table->datetime('actualizado_en')->useCurrent()->useCurrentOnUpdate();
            
            $table->index('correo');
            $table->index('rol_id');
            $table->index(['apellido_paterno', 'apellido_materno', 'nombre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};