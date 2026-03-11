@extends('layouts.cliente')

@section('title', 'Inicio')

@section('content')
    <!-- Hero -->
    <div style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1920') no-repeat center/cover; padding: 6rem 0;">
        <div class="container" style="text-align: center; color: white;">
            <h1 style="color: #ffffff; font-size: 4rem; margin-bottom: 1rem;">S-OLARE</h1>
            <p style="color: #edebe8; font-size: 1.3rem; max-width: 600px; margin: 0 auto;">
                Diseño y artesanía contemporánea
            </p>
        </div>
    </div>

    <div class="container" style="padding: 4rem 0;">
        <!-- Colecciones -->
        <h2 class="section-title">COLECCIONES</h2>
        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1rem; margin-bottom: 4rem;">
            @foreach(['KULTE', 'PAM', 'KAMBUL', 'BACALAR', 'TULUM'] as $coleccion)
            <a href="#" style="background-color: #edebe8; padding: 1rem; text-align: center; color: #50594e; text-decoration: none; font-weight: bold; border-radius: 5px;">
                {{ $coleccion }}
            </a>
            @endforeach
        </div>

        <!-- Destacados -->
        <h2 class="section-title">NUEVOS PRODUCTOS</h2>
        <div class="product-grid">
            @foreach(range(1,4) as $item)
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1580480055273-228ff5388ef8?w=400&h=300&fit=crop" 
                     alt="Producto" class="product-img">
                <div class="product-body">
                    <div class="product-collection">KULTE</div>
                    <h3 class="product-title">Silla Tejida</h3>
                    <p class="product-price">$2,499</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tipos -->
        <h2 class="section-title">EXPLORA POR TIPO</h2>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
            @foreach(['SILLAS', 'BANCOS', 'MESAS AUXILIARES', 'MESAS COMEDOR', 'CAMASTROS', 'SALAS', 'ACCESORIOS'] as $tipo)
            <a href="#" style="border: 1px solid #edebe8; padding: 1.5rem; text-align: center; color: #757575; text-decoration: none; border-radius: 5px;">
                {{ $tipo }}
            </a>
            @endforeach
        </div>
    </div>
@endsection