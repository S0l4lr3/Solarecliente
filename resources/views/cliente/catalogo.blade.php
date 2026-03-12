@extends('layouts.cliente')

@section('title', 'Catálogo de Exterior')

@section('content')
<style>
    /* Grid Responsivo de Productos */
    .product-grid {
        display: grid;
        gap: 2rem;
        margin: 2rem 0;
        grid-template-columns: repeat(1, 1fr); /* Móvil por defecto */
    }

    @media (min-width: 640px) {
        .product-grid { grid-template-columns: repeat(2, 1fr); } /* Tablets */
    }

    @media (min-width: 1024px) {
        .product-grid { grid-template-columns: repeat(4, 1fr); } /* Escritorio */
    }

    /* Layout de Catálogo */
    .catalog-layout {
        display: grid;
        gap: 2rem;
        grid-template-columns: 1fr;
    }

    @media (min-width: 1024px) {
        .catalog-layout { grid-template-columns: 250px 1fr; }
    }

    .filter-sidebar {
        display: none; /* Oculto en móvil por ahora para priorizar catálogo */
    }

    @media (min-width: 1024px) {
        .filter-sidebar { display: block; }
    }
</style>

<div class="container" style="padding: 3rem 20px;">
    <div class="catalog-layout">
        
        <!-- Sidebar de Filtros (Solo Escritorio) -->
        <aside class="filter-sidebar">
            <div class="filter-section">
                <h3 class="filter-title">COLECCIONES</h3>
                <ul class="filter-list">
                    @foreach(['SOLARE CLASSIC', 'TERRAZA', 'RESORT', 'JARDÍN'] as $coleccion)
                    <li><a href="#">{{ $coleccion }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="filter-section">
                <h3 class="filter-title">TIPO DE MUEBLE</h3>
                <ul class="filter-list">
                    @foreach(['TODOS', 'SILLAS', 'MESAS', 'CAMASTROS', 'SALAS'] as $cat)
                    <li>
                        <a href="{{ route('catalogo', ['tipo' => $cat]) }}" 
                           style="{{ $tipo == $cat ? 'color: #958174; font-weight: bold; border-left: 2px solid #958174; padding-left: 10px;' : '' }}">
                           {{ $cat }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Zona de Catálogo -->
        <section>
            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 2rem; border-bottom: 1px solid #edebe8; padding-bottom: 1rem;">
                <h1 class="serif" style="font-size: 2rem; letter-spacing: 2px;">Colección de Exterior</h1>
                <span style="font-size: 10px; font-weight: bold; color: #999; text-transform: uppercase; letter-spacing: 1px;">
                    {{ count($muebles) }} PIEZAS DISPONIBLES
                </span>
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
                    
                    <a href="{{ route('producto.show', $mueble['id']) }}" style="text-decoration: none; color: inherit;">
                        <div style="overflow: hidden; background-color: #f9f9f9;">
                            <img src="{{ $imagenUrl }}" alt="{{ $mueble['nombre'] }}" class="product-img" style="transition: transform 0.6s ease;">
                        </div>
                    </a>
                    
                    <div class="product-body" style="text-align: center; display: flex; flex-direction: column; justify-content: space-between; min-height: 180px;">
                        <div>
                            <div class="product-collection">SOLARE EXTERIOR</div>
                            <h3 class="product-title" style="min-height: 50px; display: flex; align-items: center; justify-content: center;">
                                {{ $mueble['nombre'] }}
                            </h3>
                            <p class="product-price">${{ number_format($mueble['precio_base'], 2) }}</p>
                        </div>
                        
                        <div style="margin: 1rem auto 0; display: flex; gap: 10px; width: fit-content; align-items: center;">
                            <form action="{{ route('carrito.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $mueble['id'] }}">
                                <input type="hidden" name="nombre" value="{{ $mueble['nombre'] }}">
                                <input type="hidden" name="precio" value="{{ $mueble['precio_base'] }}">
                                <input type="hidden" name="imagen" value="{{ $imagenUrl }}">
                                <button type="submit" class="btn btn-primary" style="font-size: 9px; padding: 12px 40px; min-width: 140px;">AÑADIR AL CARRITO</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 8rem 0;">
                    <p class="serif" style="font-size: 1.2rem; opacity: 0.5; letter-spacing: 2px;">ESTAMOS PREPARANDO LA NUEVA TEMPORADA.</p>
                </div>
                @endforelse
            </div>
        </section>
    </div>
</div>

<script>
    // Efecto de zoom suave en las imágenes al pasar el mouse
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.querySelector('.product-img').style.transform = 'scale(1.05)';
        });
        card.addEventListener('mouseleave', () => {
            card.querySelector('.product-img').style.transform = 'scale(1)';
        });
    });
</script>
@endsection
