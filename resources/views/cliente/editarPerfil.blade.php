@extends('layouts.cliente')

@section('title', 'Editar Perfil')

@section('content')

<section class="bg-white dark:bg-gray-900 p-6 sm:p-10 rounded-2xl shadow-2xl max-w-3xl mx-auto border border-gray-100 dark:border-gray-800">

    {{-- Encabezado --}}
    <div class="flex flex-col sm:flex-row items-center justify-between mb-10 pb-8 border-b border-gray-200 dark:border-gray-700 gap-4">
        <div class="text-center sm:text-left">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Editar Perfil</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Actualiza tu información personal.</p>
        </div>

        <a href="{{ route('cliente.perfil') }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver al perfil
        </a>
    </div>

    {{-- Mensajes de éxito / error --}}
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-400 rounded-xl px-4 py-3 text-sm">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 text-red-700 dark:text-red-400 rounded-xl px-4 py-3 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario --}}
    <form action="{{ route('cliente.perfil.update') }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- Sección: Datos Personales --}}
        <div>
            <h3 class="text-xs font-bold text-blue-500 dark:text-blue-400 mb-6 flex items-center uppercase tracking-widest">
                <span class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-lg mr-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </span>
                Datos Personales
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="flex flex-col">
                    <label for="nombre" class="block mb-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase ml-1">
                        Nombre(s) <span class="text-red-400">*</span>
                    </label>
                    <input type="text" id="nombre" name="nombre"
                           value="{{ old('nombre', $user['nombre'] ?? '') }}"
                           class="w-full bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-xl p-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('nombre') border-red-400 @enderror"
                           placeholder="Ej. Juan Carlos" required>
                    @error('nombre')
                        <p class="mt-1 text-xs text-red-500 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="apellido_paterno" class="block mb-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase ml-1">
                        Apellido Paterno <span class="text-red-400">*</span>
                    </label>
                    <input type="text" id="apellido_paterno" name="apellido_paterno"
                           value="{{ old('apellido_paterno', $user['apellido_paterno'] ?? '') }}"
                           class="w-full bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-xl p-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('apellido_paterno') border-red-400 @enderror"
                           placeholder="Ej. García" required>
                    @error('apellido_paterno')
                        <p class="mt-1 text-xs text-red-500 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="apellido_materno" class="block mb-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase ml-1">
                        Apellido Materno
                    </label>
                    <input type="text" id="apellido_materno" name="apellido_materno"
                           value="{{ old('apellido_materno', $user['apellido_materno'] ?? '') }}"
                           class="w-full bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-xl p-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('apellido_materno') border-red-400 @enderror"
                           placeholder="Ej. López">
                    @error('apellido_materno')
                        <p class="mt-1 text-xs text-red-500 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col md:col-span-3">
                    <label for="correo" class="block mb-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase ml-1">
                        Correo Electrónico <span class="text-red-400">*</span>
                    </label>
                    <input type="email" id="correo" name="correo"
                           value="{{ old('correo', $user['correo'] ?? '') }}"
                           class="w-full bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-xl p-4 shadow-sm font-mono tracking-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('correo') border-red-400 @enderror"
                           placeholder="correo@ejemplo.com" required>
                    @error('correo')
                        <p class="mt-1 text-xs text-red-500 ml-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Sección: Cambiar contraseña (opcional) --}}
        <div>
            <h3 class="text-xs font-bold text-blue-500 dark:text-blue-400 mb-6 flex items-center uppercase tracking-widest">
                <span class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-lg mr-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </span>
                Cambiar Contraseña
                <span class="ml-3 text-xs text-gray-400 dark:text-gray-500 normal-case tracking-normal font-normal">(opcional)</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="flex flex-col">
                    <label for="password" class="block mb-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase ml-1">
                        Nueva Contraseña
                    </label>
                    <input type="password" id="password" name="password"
                           class="w-full bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-xl p-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('password') border-red-400 @enderror"
                           placeholder="Mínimo 8 caracteres" autocomplete="new-password">
                    @error('password')
                        <p class="mt-1 text-xs text-red-500 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="password_confirmation" class="block mb-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase ml-1">
                        Confirmar Contraseña
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="w-full bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-xl p-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                           placeholder="Repite la contraseña" autocomplete="new-password">
                </div>

            </div>
        </div>

        {{-- Botones --}}
        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-800">
            <a href="{{ route('cliente.perfil') }}"
               class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-700 transition-all">
                Cancelar
            </a>
            <button type="submit"
                    class="inline-flex items-center justify-center px-8 py-3 text-sm font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Guardar Cambios
            </button>
        </div>

    </form>

</section>

@endsection