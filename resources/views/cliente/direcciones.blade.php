@extends('layouts.app') @section('content')
<div class="container mx-auto px-4 py-10 max-w-5xl">
    
    <div class="flex justify-between items-center mb-8 border-b pb-4">
        <h1 class="text-3xl font-light text-gray-800">Mis Direcciones de Envío</h1>
        <a href="#" class="bg-solare-musgo text-white px-6 py-2 rounded-lg hover:bg-opacity-90 transition shadow-sm">
            + Añadir Dirección
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-6 relative">
            <span class="absolute top-4 right-4 bg-blue-50 text-blue-600 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">
                Principal
            </span>
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Mi Casa</h2>
            <p class="text-gray-600 text-sm mb-1">Av. Siempre Viva #742</p>
            <p class="text-gray-600 text-sm mb-1">Col. Springfield, C.P. 12345</p>
            <p class="text-gray-600 text-sm mb-4">Ciudad de México, CDMX, México</p>
            <p class="text-gray-500 text-xs italic mb-4">Ref: Casa de dos pisos con puerta verde.</p>
            
            <div class="flex space-x-4 border-t pt-4 mt-2">
                <a href="#" class="text-blue-600 text-sm hover:underline font-medium">Editar</a>
                <button class="text-red-500 text-sm hover:underline font-medium">Eliminar</button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Oficina</h2>
            <p class="text-gray-600 text-sm mb-1">Calle Reforma #220 Int. 4B</p>
            <p class="text-gray-600 text-sm mb-1">Col. Centro, C.P. 54321</p>
            <p class="text-gray-600 text-sm mb-4">Guadalajara, Jalisco, México</p>
            <p class="text-gray-500 text-xs italic mb-4">Ref: Edificio corporativo de cristal.</p>
            
            <div class="flex space-x-4 border-t pt-4 mt-2">
                <a href="#" class="text-blue-600 text-sm hover:underline font-medium">Editar</a>
                <button class="text-red-500 text-sm hover:underline font-medium">Eliminar</button>
            </div>
        </div>

    </div>
</div>
@endsection