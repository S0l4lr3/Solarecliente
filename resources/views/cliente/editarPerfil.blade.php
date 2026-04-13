@extends('layouts.cliente')

@section('title', 'Editar Perfil')

@section('content')

<div class="container" style="margin-top: 5rem; margin-bottom: 7rem;">
    <div style="max-width: 900px; margin: 0 auto;">
        
        {{-- Encabezado --}}
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 4rem; border-bottom: 1px solid var(--color-sand-beige); padding-bottom: 2rem;">
            <div>
                <h1 class="serif" style="font-size: 3.5rem; color: var(--color-dark-moss); margin-bottom: 1rem;">Editar Perfil</h1>
                <p style="font-size: 19px; text-transform: uppercase; letter-spacing: 2px; color: var(--color-clay-brown); font-weight: 700;">Actualiza tu información personal de cuenta</p>
            </div>
            <a href="{{ route('cliente.perfil') }}" style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px; color: #999; text-decoration: none; font-weight: 700;">← Volver al Perfil</a>
        </div>

        {{-- Mensajes de Alerta --}}
        @if(session('success'))
            <div style="background-color: #f0fdf4; color: #166534; padding: 20px; border-radius: 4px; margin-bottom: 3rem; font-size: 16px; border: 1px solid #bbf7d0;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background-color: #fef2f2; color: #991b1b; padding: 20px; border-radius: 4px; margin-bottom: 3rem; font-size: 16px; border: 1px solid #fecaca;">
                <ul style="list-style: none;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cliente.perfil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem;">
                
                {{-- Columna 1: Datos Personales --}}
                <div>
                    <h3 class="serif" style="font-size: 1.8rem; margin-bottom: 3rem; color: var(--color-dark-moss);">Datos Personales</h3>
                    
                    <div style="margin-bottom: 2.5rem;">
                        <label style="display: block; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Nombre(s)</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $user['nombre'] ?? '') }}" 
                               style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #fafafa;" required>
                    </div>

                    <div style="margin-bottom: 2.5rem;">
                        <label style="display: block; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $user['apellido_paterno'] ?? '') }}" 
                               style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #fafafa;" required>
                    </div>

                    <div style="margin-bottom: 2.5rem;">
                        <label style="display: block; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Apellido Materno</label>
                        <input type="text" name="apellido_materno" value="{{ old('apellido_materno', $user['apellido_materno'] ?? '') }}" 
                               style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #fafafa;">
                    </div>

                    <div style="margin-bottom: 2.5rem;">
                        <label style="display: block; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Correo Electrónico</label>
                        <input type="email" name="correo" value="{{ old('correo', $user['correo'] ?? '') }}" 
                               style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #fafafa;" required>
                    </div>

                    <div style="margin-bottom: 2.5rem;">
                        <label style="display: block; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Teléfono de Contacto</label>
                        <input type="tel" name="telefono" value="{{ old('telefono', $user['telefono'] ?? '') }}" 
                               style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #ffffff;">
                    </div>

                    <div style="margin-bottom: 2.5rem;">
                        <label style="display: block; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Identificación Fiscal (RFC)</label>
                        <input type="text" name="rfc" value="{{ old('rfc', $user['rfc'] ?? '') }}" 
                               style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #ffffff; text-transform: uppercase;">
                    </div>
                </div>

                {{-- Columna 2: Seguridad --}}
                <div style="background-color: #f9f9f9; padding: 4rem; border-radius: 4px;">
                    <h3 class="serif" style="font-size: 1.8rem; margin-bottom: 3rem; color: var(--color-dark-moss);">Seguridad</h3>
                    <p style="font-size: 14px; color: #777; margin-bottom: 3rem; line-height: 1.6;">Deja estos campos vacíos si no deseas cambiar tu contraseña actual.</p>

                    <div style="margin-bottom: 2.5rem;">
                        <label style="display: block; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Nueva Contraseña</label>
                        <input type="password" name="password" 
                               style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #ffffff;" autocomplete="new-password">
                    </div>

                    <div style="margin-bottom: 2.5rem;">
                        <label style="display: block; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" 
                               style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #ffffff;" autocomplete="new-password">
                    </div>

                    <div style="margin-top: 4rem; text-align: right;">
                        <button type="submit" class="btn btn-primary" style="padding: 15px 40px; font-size: 14px; width: auto; display: inline-block;">Guardar Cambios</button>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>

@endsection