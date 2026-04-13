@extends('layouts.cliente')

@section('title', 'Mi Perfil')

@section('content')

<div class="container" style="margin-top: 5rem; margin-bottom: 7rem;">
    <div style="max-width: 1100px; margin: 0 auto;">
        
        {{-- Mensajes de estado --}}
        @if(session('success'))
            <div style="background-color: #f0f3ef; color: #50594e; padding: 1.5rem; border-radius: 4px; margin-bottom: 3rem; font-size: 14px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; border-left: 4px solid #50594e;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Encabezado de Perfil --}}
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 5rem; border-bottom: 1px solid var(--color-sand-beige); padding-bottom: 2.5rem;">
            <div>
                <h1 class="serif" style="font-size: 3.5rem; color: var(--color-dark-moss); margin-bottom: 1rem;">Mi Perfil</h1>
                <p style="font-size: 14px; text-transform: uppercase; letter-spacing: 2px; color: var(--color-clay-brown); font-weight: 700;">Gestiona tu información personal y de facturación</p>
            </div>
            <a href="{{ route('cliente.perfil.editar') }}" class="btn btn-primary" style="padding: 12px 30px; font-size: 13px; width: auto; display: inline-block;">Editar Datos</a>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5rem;">
            
            {{-- Columna 1: Datos Personales --}}
            <div>
                <h3 class="serif" style="font-size: 1.8rem; margin-bottom: 3rem; color: var(--color-dark-moss);">Datos de la Cuenta</h3>
                
                <div style="margin-bottom: 2.5rem;">
                    <label style="display: block; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 0.5rem; color: #999;">Nombre Completo</label>
                    <p style="font-size: 18px; color: #333;">{{ $user['nombre'] }} {{ $user['apellido_paterno'] }} {{ $user['apellido_materno'] }}</p>
                </div>

                <div style="margin-bottom: 2.5rem;">
                    <label style="display: block; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 0.5rem; color: #999;">Correo Electrónico</label>
                    <p style="font-size: 18px; color: #333;">{{ $user['correo'] }}</p>
                </div>

                {{-- Datos del Cliente (Tabla clientes) --}}
                @if(isset($user['cliente']))
                <div style="margin-bottom: 2.5rem;">
                    <label style="display: block; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 0.5rem; color: #999;">Teléfono de Contacto</label>
                    <p style="font-size: 18px; color: #333;">{{ $user['cliente']['telefono'] ?? 'No registrado' }}</p>
                </div>

                <div style="margin-bottom: 2.5rem;">
                    <label style="display: block; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 0.5rem; color: #999;">RFC / Identificación Fiscal</label>
                    <p style="font-size: 18px; color: #333;">{{ $user['cliente']['identificacion_fiscal'] ?? 'No registrado' }}</p>
                </div>
                @endif
            </div>

            {{-- Columna 2: Mis Direcciones --}}
            <div>
                <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 3rem;">
                    <h3 class="serif" style="font-size: 1.8rem; color: var(--color-dark-moss);">Direcciones de Envío</h3>
                    <a href="{{ route('cliente.direccion') }}" style="font-size: 11px; font-weight: bold; color: #958174; text-transform: uppercase; letter-spacing: 1px; text-decoration: none;">+ Agregar</a>
                </div>
                
                @forelse($direcciones as $dir)
                    <div style="background-color: #fcfaf7; padding: 2rem; border-radius: 4px; border: 1px solid #95817422; margin-bottom: 1.5rem; position: relative;">
                        <p style="font-size: 14px; line-height: 1.6; color: #444;">
                            <strong style="color: #958174; text-transform: uppercase; font-size: 11px;">{{ $dir['alias'] }}</strong><br>
                            {{ $dir['calle'] }}<br>
                            Col. {{ $dir['colonia'] }}, {{ $dir['ciudad'] }}<br>
                            {{ $dir['estado'] }}, C.P. {{ $dir['codigo_postal'] }}
                        </p>
                        
                        <form action="{{ route('cliente.direccion.eliminar', $dir['id']) }}" method="POST" style="position: absolute; top: 15px; right: 15px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ccc; cursor: pointer; font-size: 1.2rem;" onmouseover="this.style.color='#e53e3e'" onmouseout="this.style.color='#ccc'">×</button>
                        </form>
                    </div>
                @empty
                    <p style="font-size: 14px; color: #888; font-style: italic;">No has registrado ninguna dirección aún.</p>
                @endforelse
            </div>

        </div>

    </div>
</div>

@endsection
