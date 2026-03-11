<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('variantes_producto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->cascadeOnDelete();
            $table->foreignId('material_id')->constrained('materiales');
            $table->string('color', 50);
            $table->decimal('precio_adicional', 10, 2)->default(0);
            $table->integer('existencias')->default(0);
            $table->string('sku_especifico', 50)->unique();
            $table->boolean('activo')->default(true);
            $table->datetime('creado_en')->useCurrent();
            $table->datetime('actualizado_en')->useCurrent()->useCurrentOnUpdate();
            
            $table->unique(['producto_id', 'material_id', 'color'], 'uk_producto_material_color');
            $table->index('producto_id');
            $table->index('material_id');
            $table->index('sku_especifico');
            $table->index('existencias');
            $table->index('activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('variantes_producto');
    }
};