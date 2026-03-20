@extends('layouts.cliente')

@section('title', 'Catálogo de Exterior')

@section('content')
    <style>
        /* Grid Responsivo de Productos */
        .product-grid {
            display: grid;
            gap: 2rem;
            margin: 2rem 0;
            grid-template-columns: repeat(1, 1fr);
            /* Móvil por defecto */
        }

        @media (min-width: 640px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            /* Tablets */
        }

        @media (min-width: 1024px) {
            .product-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            /* Escritorio */
        }

        /* Layout de Catálogo */
        .catalog-layout {
            display: grid;
            gap: 2rem;
            grid-template-columns: 1fr;
        }

        @media (min-width: 1024px) {
            .catalog-layout {
                grid-template-columns: 250px 1fr;
            }
        }

        .filter-sidebar {
            display: none;
            /* Oculto en móvil por ahora para priorizar catálogo */
        }

        @media (min-width: 1024px) {
            .filter-sidebar {
                display: block;
            }
        }

        /* Estilos para el menú desplegable */
        .custom-select {
            width: 100%;
            padding: 12px;
            border: 1px solid #edebe8;
            border-radius: 0;
            font-family: inherit;
            font-size: 13px;
            color: #333;
            background-color: transparent;
            margin-top: 10px;
            cursor: pointer;
            appearance: none;
            /* Quita la flecha por defecto en algunos navegadores para un look más limpio */
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }

        .custom-select:focus {
            outline: none;
            border-color: #958174;
        }
    </style>

    <div class="container" style="padding: 3rem 20px;">
        <div class="catalog-layout">

            <!-- Sidebar de Filtros (Solo Escritorio) -->
            <aside class="filter-sidebar">
                {{-- <div class="filter-section">
                    <h3 class="filter-title">COLECCIONES</h3>
                    <ul class="filter-list">
                        <li>
                            <a href="{{ route('catalogo', ['coleccion' => 'TODAS', 'tipo' => $tipo]) }}"
                                style="{{ $coleccion == 'TODAS' ? 'color: #958174; font-weight: bold;' : '' }}">
                                TODAS
                            </a>
                        </li>
                        @foreach (['SOLARE CLASSIC', 'TERRAZA', 'RESORT', 'JARDÍN'] as $col)
                            <li>
                                <a href="{{ route('catalogo', ['coleccion' => $col, 'tipo' => $tipo]) }}"
                                    style="{{ $coleccion == $col ? 'color: #958174; font-weight: bold; border-left: 2px solid #958174; padding-left: 10px;' : '' }}">
                                    {{ $col }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div> --}}

                <div class="filter-section">
                    <h3 class="filter-title"
                        style="font-size: 12px; letter-spacing: 1px; margin-bottom: 0.5rem; color: #333;">
                        TIPO DE MUEBLE
                    </h3>

                    <select class="custom-select" onchange="window.location.href=this.value;">
                        <option value="{{ route('catalogo', ['categoria_id' => 'TODOS']) }}"
                            {{ $categoria_id == 'TODOS' ? 'selected' : '' }}>
                            TODOS
                        </option>

                        @foreach ($categorias as $cat)
                            <option value="{{ route('catalogo', ['categoria_id' => $cat['id']]) }}"
                                {{ $categoria_id == $cat['id'] ? 'selected' : '' }}>
                                {{ strtoupper($cat['nombre']) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </aside>

            <!-- Zona de Catálogo -->
            <section>
                <div
                    style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 2rem; border-bottom: 1px solid #edebe8; padding-bottom: 1rem;">
                    <h1 class="serif" style="font-size: 2rem; letter-spacing: 2px;">Colección de Exterior</h1>
                    <span
                        style="font-size: 10px; font-weight: bold; color: #999; text-transform: uppercase; letter-spacing: 1px;">
                        {{ count($muebles) }} PIEZAS DISPONIBLES
                    </span>
                </div>

                <div class="product-grid">
                    @forelse($muebles as $mueble)
                        <div class="product-card">
                            @php
                                $imagenUrl = 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?fm=webp';
                                if (!empty($mueble['full_image_url'])) {
                                    $imagenUrl = $mueble['full_image_url'] ?? $imagenUrl;
                                }
                            @endphp

                            <a href="{{ route('producto.show', $mueble['id']) }}"
                                style="text-decoration: none; color: inherit;">
                                <div style="overflow: hidden; background-color: #f9f9f9;">
                                    <img src="{{ $imagenUrl }}" alt="{{ $mueble['nombre'] }}" class="product-img"
                                        style="transition: transform 0.6s ease;">
                                </div>
                            </a>

                            <div class="product-body"
                                style="text-align: center; display: flex; flex-direction: column; justify-content: space-between; min-height: 180px;">
                                <div>
                                    <div class="product-collection">SOLARE EXTERIOR</div>
                                    <h3 class="product-title"
                                        style="min-height: 50px; display: flex; align-items: center; justify-content: center;">
                                        {{ $mueble['nombre'] }}
                                    </h3>
                                    <p class="product-price">${{ number_format($mueble['precio_base'], 2) }}</p>
                                </div>

                                <div
                                    style="margin: 1rem auto 0; display: flex; gap: 10px; width: fit-content; align-items: center;">
                                    <form action="{{ route('carrito.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $mueble['id'] }}">
                                        <input type="hidden" name="nombre" value="{{ $mueble['nombre'] }}">
                                        <input type="hidden" name="precio" value="{{ $mueble['precio_base'] }}">
                                        <input type="hidden" name="imagen" value="{{ $imagenUrl }}">
                                        <button type="submit" class="btn btn-primary"
                                            style="font-size: 9px; padding: 12px 40px; min-width: 140px;">AÑADIR AL
                                            CARRITO</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: 8rem 0;">
                            <p class="serif" style="font-size: 1.2rem; opacity: 0.5; letter-spacing: 2px;">ESTAMOS
                                PREPARANDO LA NUEVA TEMPORADA.</p>
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
