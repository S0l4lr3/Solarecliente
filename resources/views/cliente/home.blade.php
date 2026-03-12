@extends('layouts.cliente')

@section('title', 'Inicio')

@section('content')
    <!-- Hero -->
    <div style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1920') no-repeat center/cover; padding: 10rem 0;">
        <div class="container" style="text-align: center; color: white;">
            <h1 class="serif" style="color: #ffffff; font-size: 5rem; margin-bottom: 1rem; letter-spacing: 12px; font-weight: 400;">SOLARE</h1>
            <p style="color: #edebe8; font-size: 1.1rem; max-width: 600px; margin: 0 auto; letter-spacing: 4px; text-transform: uppercase; opacity: 0.9; font-weight: 600;">
                Diseño y artesanía contemporánea para exterior
            </p>
            <div style="margin-top: 3rem;">
                <a href="/catalogo" class="btn btn-primary" style="padding: 15px 40px; font-size: 11px;">Descubrir Colección</a>
            </div>
        </div>
    </div>

    <div class="container" style="padding: 6rem 20px;">
        <!-- Colecciones -->
        <div style="text-align: center; margin-bottom: 4rem;">
            <span class="product-collection" style="display: block; margin-bottom: 1rem;">Nuestras Líneas</span>
            <h2 class="serif" style="font-size: 2.5rem; color: #000;">Explora las Colecciones</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 6rem;">
            @foreach(['SOLARE CLASSIC', 'TERRAZA', 'RESORT', 'JARDÍN', 'BALCÓN'] as $coleccion)
            <a href="/catalogo" style="background-color: #f9f9f9; padding: 2.5rem 1rem; text-align: center; color: #50594e; text-decoration: none; font-weight: bold; border: 1px solid #eee; transition: all 0.3s; font-size: 10px; letter-spacing: 2px;">
                {{ $coleccion }}
            </a>
            @endforeach
        </div>

        <!-- Destacados -->
        <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 3rem; border-bottom: 1px solid #edebe8; padding-bottom: 1rem;">
            <h2 class="serif" style="font-size: 2rem;">Nuevas Piezas</h2>
            <a href="/catalogo" style="font-size: 10px; font-weight: bold; color: #958174; text-decoration: none; letter-spacing: 1px; text-transform: uppercase;">Ver todo →</a>
        </div>

        <div class="product-grid">
            @forelse($muebles as $mueble)
                <div class="product-card">
                    @php 
                        $imagenUrl = 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?fm=webp'; 
                        if(!empty($mueble['imagenes'])) {
                            $imagenUrl = $mueble['imagenes'][0]['url'] ?? $imagenUrl;
                        }
                    @endphp
                    <div style="overflow: hidden; background-color: #f9f9f9;">
                        <img src="{{ $imagenUrl }}" alt="{{ $mueble['nombre'] }}" class="product-img" style="height: 350px;">
                    </div>
                    <div class="product-body">
                        <div class="product-collection">SOLARE EXTERIOR</div>
                        <h3 class="product-title">{{ $mueble['nombre'] }}</h3>
                        <p class="product-price">${{ number_format($mueble['precio_base'], 2) }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center" style="grid-column: 1/-1; opacity: 0.5;">Cargando piezas exclusivas...</p>
            @endforelse
        </div>
    </div>
@endsection
