@extends('layouts.app') 

@section('content')
<div class="container mx-auto px-4 py-10 max-w-3xl">
    
    <h1 class="text-3xl font-light text-gray-800 mb-2">Editar Dirección</h1>
    <p class="text-gray-500 mb-8">Actualiza los datos de tu dirección de envío.</p>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form action="#" method="POST">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre de la dirección (Alias)</label>
                    <input type="text" name="alias" value="Mi Casa" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg p-2.5 outline-none" required>
                </div>
                <div class="flex items-center mt-6">
                    <input type="checkbox" name="es_principal" id="es_principal" checked class="w-4 h-4 text-solare-musgo bg-gray-100 border-gray-300 rounded">
                    <label for="es_principal" class="ml-2 text-sm font-medium text-gray-700">Usar como dirección principal</label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Calle</label>
                    <input type="text" name="calle" value="Av. Siempre Viva" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg p-2.5 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Núm. Exterior</label>
                    <input type="text" name="numero_exterior" value="742" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg p-2.5 outline-none" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Núm. Interior</label>
                    <input type="text" name="numero_interior" value="" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg p-2.5 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Código Postal</label>
                    <input type="text" name="codigo_postal" value="12345" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg p-2.5 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Colonia</label>
                    <input type="text" name="colonia" value="Springfield" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg p-2.5 outline-none" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ciudad / Municipio</label>
                    <input type="text" name="ciudad" value="Ciudad de México" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg p-2.5 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <input type="text" name="estado" value="CDMX" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg p-2.5 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">País</label>
                    <input type="text" name="pais" value="México" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg p-2.5 outline-none" required>
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700 mb-1">Referencias de entrega</label>
                <textarea name="referencias" rows="3" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg p-2.5 outline-none">Casa de dos pisos con puerta verde.</textarea>
            </div>

            <div class="flex items-center justify-end gap-4 border-t pt-6">
                <a href="#" class="text-gray-500 hover:text-gray-700 text-sm font-medium px-4 py-2">Cancelar</a>
                <button type="button" class="bg-solare-musgo text-white text-sm font-medium px-6 py-2.5 rounded-lg hover:bg-opacity-90 shadow-sm">
                    Actualizar Dirección
                </button>
            </div>
        </form>
    </div>
</div>
@endsection