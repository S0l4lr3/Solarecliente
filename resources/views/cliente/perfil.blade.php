@extends('layouts.cliente')

@section('title', 'Mi Perfil')

@section('content')

<div class="container" style="margin-top: 5rem; margin-bottom: 7rem;">
    <div style="max-width: 1100px; margin: 0 auto;">
        
        {{-- Encabezado de Perfil --}}
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 5rem; border-bottom: 1px solid var(--color-sand-beige); padding-bottom: 2.5rem;">
            <div>
                <h1 class="serif" style="font-size: 3.5rem; color: var(--color-dark-moss); margin-bottom: 1rem;">Mi Perfil</h1>
                <p style="font-size: 19px; text-transform: uppercase; letter-spacing: 2px; color: var(--color-clay-brown); font-weight: 700;">Gestiona tu información personal y de facturación</p>
            </div>
            <a href="{{ route('cliente.perfil.editar') }}" class="btn btn-primary" style="padding: 12px 30px; font-size: 13px; width: auto; display: inline-block;">Editar Datos</a>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5rem;">
            
            {{-- Columna 1: Datos Personales --}}
            <div>
                <h3 class="serif" style="font-size: 1.8rem; margin-bottom: 3rem; color: var(--color-dark-moss);">Datos de la Cuenta</h3>
                
                <div style="margin-bottom: 2.5rem;">
                    <label style="display: block; font-size: 17px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Nombre Completo</label>
                    <p style="font-size: 22px; color: #333; font-weight: 400;">{{ $user['nombre'] }} {{ $user['apellido_paterno'] }} {{ $user['apellido_materno'] }}</p>
                </div>

                <div style="margin-bottom: 2.5rem;">
                    <label style="display: block; font-size: 17px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Correo Electrónico</label>
                    <p style="font-size: 22px; color: #333;">{{ $user['correo'] }}</p>
                </div>

                <div style="margin-bottom: 2.5rem;">
                    <label style="display: block; font-size: 17px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Teléfono de Contacto</label>
                    <p style="font-size: 22px; color: #333;">{{ $user['telefono'] ?? 'No registrado' }}</p>
                </div>

                <div style="margin-bottom: 2.5rem;">
                    <label style="display: block; font-size: 17px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Identificación Fiscal (RFC)</label>
                    <p style="font-size: 22px; color: #333; text-transform: uppercase;">{{ $user['rfc'] ?? 'No registrado' }}</p>
                </div>
            </div>

            {{-- Columna 2: Dirección Principal --}}
            <div style="background-color: #f9f9f9; padding: 4rem; border-radius: 4px;">
                <h3 class="serif" style="font-size: 1.8rem; margin-bottom: 3rem; color: var(--color-dark-moss);">Dirección de Envío</h3>
                
                @if(isset($user['calle']))
                    <div style="margin-bottom: 2rem;">
                        <p style="font-size: 22px; line-height: 1.8; color: #444;">
                            <strong>{{ $user['alias'] ?? 'Principal' }}</strong><br>
                            {{ $user['calle'] }} #{{ $user['numero_exterior'] }} {{ $user['numero_interior'] ? 'Int. ' . $user['numero_interior'] : '' }}<br>
                            Col. {{ $user['colonia'] }}<br>
                            {{ $user['ciudad'] }}, {{ $user['estado'] }}<br>
                            C.P. {{ $user['codigo_postal'] }}<br>
                            {{ $user['pais'] }}
                        </p>
                    </div>
                    
                    @if(isset($user['referencias']))
                        <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #eee;">
                            <label style="display: block; font-size: 17px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #999;">Referencias</label>
                            <p style="font-size: 20px; color: #666; font-style: italic;">"{{ $user['referencias'] }}"</p>
                        </div>
                    @endif
                @else
                    <p style="font-size: 20px; color: #888; margin-bottom: 4rem;">No has registrado una dirección de envío principal.</p>
                @endif

                <a href="{{ route('cliente.direccion') }}" style="display: inline-block; font-size: 17px; text-transform: uppercase; letter-spacing: 2px; color: var(--color-clay-brown); font-weight: 700; text-decoration: none; margin-top: 2rem; border-bottom: 2px solid var(--color-clay-brown); padding-bottom: 5px;">
                    Gestionar Direcciones →
                </a>
            </div>

        </div>

        {{-- Sección de Seguridad --}}
        <div style="margin-top: 7rem; padding: 5rem; border: 1px solid var(--color-sand-beige); text-align: center;">
            <h3 class="serif" style="font-size: 1.8rem; margin-bottom: 2rem;">¿Necesitas cambiar tu contraseña?</h3>
            <p style="font-size: 19px; color: #777; margin-bottom: 3rem;">Para actualizar tu contraseña o cambiar tu correo principal, pulsa el botón de editar perfil.</p>
            <a href="{{ route('cliente.perfil.editar') }}" style="color: var(--color-dark-moss); font-size: 17px; text-transform: uppercase; letter-spacing: 2px; font-weight: 700; text-decoration: none; border-bottom: 2px solid var(--color-dark-moss); padding-bottom: 8px;">Cambiar ajustes de seguridad</a>
        </div>

    </div>
</div>

@endsection