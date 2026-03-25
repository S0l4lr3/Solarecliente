@extends('layouts.cliente')

@section('title', 'Mi Perfil')

@section('content')

<section class="bg-white dark:bg-gray-900 p-6 sm:p-10 rounded-2xl shadow-2xl max-w-3xl mx-auto border border-gray-100 dark:border-gray-800">

    {{-- Encabezado --}}
    <div class="flex flex-col sm:flex-row items-center justify-between mb-10 pb-8 border-b border-gray-200 dark:border-gray-700 gap-6">
        <div class="text-center sm:text-left">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Mi Perfil</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Información personal de tu cuenta.</p>
        </div>

        <a href="{{ route('cliente.perfil.editar') }}"
           class="group inline-flex items-center justify-center px-6 py-3 font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 transition-all duration-200 w-full sm:w-auto">
            <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Editar Perfil
        </a>
    </div>

    {{-- Sección: Información Personal --}}
    <div>
        <h3 class="text-xs font-bold text-blue-500 dark:text-blue-400 mb-6 flex items-center uppercase tracking-widest">
            <span class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-lg mr-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </span>
            Información Personal
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="flex flex-col">
                <dt class="block mb-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase ml-1">Nombre(s)</dt>
                <dd class="w-full bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700/50 text-gray-900 dark:text-white text-sm rounded-xl p-4 shadow-sm min-h-[50px] flex items-center">
                    {{ $user['nombre'] ?? 'No registrado' }}
                </dd>
            </div>

            <div class="flex flex-col">
                <dt class="block mb-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase ml-1">Apellido Paterno</dt>
                <dd class="w-full bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700/50 text-gray-900 dark:text-white text-sm rounded-xl p-4 shadow-sm min-h-[50px] flex items-center">
                    {{ $user['apellido_paterno'] ?? 'No registrado' }}
                </dd>
            </div>

            <div class="flex flex-col">
                <dt class="block mb-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase ml-1">Apellido Materno</dt>
                <dd class="w-full bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700/50 text-gray-900 dark:text-white text-sm rounded-xl p-4 shadow-sm min-h-[50px] flex items-center">
                    {{ $user['apellido_materno'] ?? 'No registrado' }}
                </dd>
            </div>

            <div class="flex flex-col md:col-span-3">
                <dt class="block mb-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase ml-1">Correo Electrónico</dt>
                <dd class="w-full bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700/50 text-gray-900 dark:text-white text-sm rounded-xl p-4 shadow-sm min-h-[50px] flex items-center font-mono tracking-tight">
                    {{ $user['correo'] ?? 'No registrado' }}
                </dd>
            </div>

        </div>
    </div>

    {{-- Acceso rápido a dirección --}}
    <div class="mt-10 pt-8 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row items-center justify-between gap-4">
        <p class="text-sm text-gray-500 dark:text-gray-400">¿Quieres ver o cambiar tu dirección de envío?</p>
        <a href="{{ route('cliente.direccion') }}" 
           class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Ver mi dirección de envío →
        </a>
    </div>

    <div class="mt-8 text-center">
        <p class="text-xs text-gray-400 tracking-wider uppercase">Panel de Control de Cliente</p>
    </div>

</section>

@endsection