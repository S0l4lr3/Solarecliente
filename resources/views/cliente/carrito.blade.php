@extends('layouts.cliente')

@section('title', 'Carrito')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <h1 style="color: #000000; margin-bottom: 2rem;">MI CARRITO</h1>
    
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        <!-- Lista de productos -->
        <div>
            @foreach(range(1,2) as $item)
            <div style="display: flex; gap: 1rem; background: #ffffff; padding: 1.5rem; border: 1px solid #edebe8; border-radius: 8px; margin-bottom: 1rem;">
                <img src="https://images.unsplash.com/{{ $item == 1 ? 'photo-1580480055273-228ff5388ef8' : 'photo-1533090481720-856c6e3c1fdc' }}?w=100&h=100&fit=crop" 
                     alt="Producto" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                <div style="flex: 1;">
                    <div class="product-collection">KULTE</div>
                    <h3 style="color: #000000;">{{ $item == 1 ? 'Silla Tejida' : 'Mesa Auxiliar' }}</h3>
                    <p class="product-price">${{ $item == 1 ? '2,499' : '3,899' }}</p>
                </div>
                <div style="text-align: center;">
                    <div style="display: flex; align-items: center; border: 1px solid #edebe8; border-radius: 5px;">
                        <button style="padding: 5px 10px; background: none; border: none;">-</button>
                        <span style="padding: 5px 15px; border-left: 1px solid #edebe8; border-right: 1px solid #edebe8;">1</span>
                        <button style="padding: 5px 10px; background: none; border: none;">+</button>
                    </div>
                </div>
                <div>
                    <button style="color: #958174; background: none; border: none;">🗑️</button>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Resumen -->
        <div style="background: #edebe8; padding: 2rem; border-radius: 8px;">
            <h2 style="color: #000000; margin-bottom: 1.5rem;">RESUMEN</h2>
            
            <div style="border-bottom: 1px solid #958174; padding-bottom: 1rem; margin-bottom: 1rem;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span>Subtotal</span>
                    <span>$6,398</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>Envío</span>
                    <span style="color: #50594e;">Gratis</span>
                </div>
            </div>
            
            <div style="display: flex; justify-content: space-between; font-size: 1.3rem; font-weight: bold; margin-bottom: 2rem;">
                <span>TOTAL</span>
                <span style="color: #50594e;">$6,398</span>
            </div>
            
            <button class="btn btn-primary" style="width: 100%; padding: 15px;">
                PROCEDER AL PAGO
            </button>
        </div>
    </div>
</div>
@endsection