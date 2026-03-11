@extends('layouts.cliente')

@section('title', 'Catálogo')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <div style="display: grid; grid-template-columns: 250px 1fr; gap: 2rem;">
        <!-- Sidebar de filtros -->
        <div>
            <div class="filter-section">
                <h3 class="filter-title">COLECCIONES</h3>
                <ul class="filter-list">
                    @foreach(['KULTE', 'PAM', 'KAMBUL', 'BACALAR', 'TULUM'] as $coleccion)
                    <li><a href="#">{{ $coleccion }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="filter-section">
                <h3 class="filter-title">TIPO</h3>
                <ul class="filter-list">
                    @foreach(['TODOS LOS PRODUCTOS', 'SILLAS', 'BANCOS', 'MESAS AUXILIARES', 'MESAS COMEDOR', 'CAMASTROS', 'SALAS', 'ACCESORIOS'] as $tipo)
                    <li><a href="#">{{ $tipo }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Grid de productos -->
        <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1 style="color: #000000;">CATÁLOGO</h1>
                <select style="padding: 0.5rem; border: 1px solid #edebe8; border-radius: 5px;">
                    <option>Ordenar por</option>
                    <option>Precio: menor a mayor</option>
                    <option>Precio: mayor a menor</option>
                </select>
            </div>

            <div class="product-grid">
                @foreach(range(1,12) as $item)
                <div class="product-card">
                    <img src="https://images.unsplash.com/{{ $item % 2 == 0 ? 'photo-1580480055273-228ff5388ef8' : 'photo-1533090481720-856c6e3c1fdc' }}?w=400&h=300&fit=crop" 
                         alt="Producto" class="product-img">
                    <div class="product-body">
                        <div class="product-collection">
                            @switch($item % 4)
                                @case(0) KULTE @break
                                @case(1) PAM @break
                                @case(2) KAMBUL @break
                                @case(3) BACALAR @break
                            @endswitch
                        </div>
                        <h3 class="product-title">
                            @switch($item % 3)
                                @case(0) Silla @break
                                @case(1) Banco @break
                                @case(2) Mesa @break
                            @endswitch
                        </h3>
                        <p class="product-price">${{ number_format(rand(1499, 8999)) }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div style="display: flex; justify-content: center; gap: 0.5rem; margin-top: 3rem;">
                <button class="btn btn-outline" disabled>⟨</button>
                <button class="btn btn-primary">1</button>
                <button class="btn btn-outline">2</button>
                <button class="btn btn-outline">3</button>
                <button class="btn btn-outline">4</button>
                <button class="btn btn-outline">5</button>
                <button class="btn btn-outline">⟩</button>
            </div>
        </div>
    </div>
</div>
@endsection