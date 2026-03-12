@extends('layouts.cliente')

@section('title', $mueble['nombre'])

@section('content')
<div class="container" style="padding: 5rem 20px;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: start;">
        
        {{-- Galería de Imágenes (Lado Izquierdo) --}}
        <div>
            @php 
                $imagenUrl = 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?fm=webp'; 
                if(!empty($mueble['imagenes'])) {
                    $imagenUrl = $mueble['imagenes'][0]['url'] ?? $imagenUrl;
                }
            @endphp
            <div style="background-color: #f9f9f9; overflow: hidden; border-radius: 4px;">
                <img src="{{ $imagenUrl }}" alt="{{ $mueble['nombre'] }}" 
                     style="width: 100%; height: 600px; object-fit: cover;">
            </div>
            
            @if(count($mueble['imagenes']) > 1)
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-top: 1rem;">
                    @foreach($mueble['imagenes'] as $img)
                        <img src="{{ $img['url'] }}" style="width: 100%; height: 100px; object-fit: cover; cursor: pointer; border: 1px solid #eee;">
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Información Técnica (Lado Derecho) --}}
        <div style="padding-top: 2rem;">
            <nav style="margin-bottom: 2rem; font-size: 10px; text-transform: uppercase; letter-spacing: 2px; color: #999;">
                <a href="/catalogo" style="color: #999; text-decoration: none;">Colección</a> / 
                <span style="color: #958174;">{{ $mueble['categoria']['nombre'] ?? 'Exterior' }}</span>
            </nav>

            <h1 class="serif" style="font-size: 3.5rem; line-height: 1.1; margin-bottom: 1.5rem; color: #000;">
                {{ $mueble['nombre'] }}
            </h1>

            <p style="font-size: 1.5rem; color: #333; font-weight: 600; margin-bottom: 3rem;">
                ${{ number_format($mueble['precio_base'], 2) }} MXN
            </p>

            <div style="border-top: 1px solid #edebe8; padding-top: 2rem; margin-bottom: 3rem;">
                <h4 style="font-size: 10px; font-weight: bold; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1rem; color: #958174;">Descripción del Mueble</h4>
                <p style="font-size: 14px; line-height: 1.8; color: #666; max-width: 450px;">
                    {{ $mueble['descripcion'] }}
                </p>
            </div>

            <div style="display: flex; gap: 1.5rem;">
                <form action="{{ route('carrito.add') }}" method="POST" style="flex: 1;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $mueble['id'] }}">
                    <input type="hidden" name="nombre" value="{{ $mueble['nombre'] }}">
                    <input type="hidden" name="precio" value="{{ $mueble['precio_base'] }}">
                    <input type="hidden" name="imagen" value="{{ $imagenUrl }}">
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 20px; font-size: 11px; letter-spacing: 2px;">
                        AÑADIR AL CARRITO
                    </button>
                </form>
                <button class="btn btn-outline" style="padding: 20px 25px;">♡</button>
            </div>

            <div style="margin-top: 4rem; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div style="font-size: 10px; color: #999; text-transform: uppercase; letter-spacing: 1px;">
                    <strong>Material:</strong><br>Certificado de Calidad Solare
                </div>
                <div style="font-size: 10px; color: #999; text-transform: uppercase; letter-spacing: 1px;">
                    <strong>Entrega:</strong><br>Distribución a toda la República
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
