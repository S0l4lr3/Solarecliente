@extends('layouts.cliente')

@section('title', '¡Pedido Realizado!')

@section('content')
<div class="container" style="padding: 5rem 20px; max-width: 600px; margin: 0 auto;">
    <div style="text-align: center;">
        {{-- Ícono de éxito --}}
        <div style="background-color: #4CAF50; color: white; width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; font-size: 50px;">
            ✓
        </div>

        {{-- Mensaje --}}
        <h1 class="serif" style="font-size: 2.5rem; margin-bottom: 1.5rem; color: #333;">¡Gracias por tu compra!</h1>
        
        <p style="font-size: 1.1rem; color: #666; margin-bottom: 2rem; line-height: 1.6;">
            Tu pedido ha sido realizado con éxito. 
            Pronto nos pondremos en contacto contigo para confirmar los detalles.
        </p>

        {{-- Botón para seguir comprando --}}
        <a href="{{ route('catalogo') }}" class="btn btn-primary" style="display: inline-block; padding: 15px 40px; font-size: 12px; text-decoration: none;">
            SEGUIR COMPRANDO
        </a>

        {{-- Enlace para volver al inicio --}}
        <div style="margin-top: 2rem;">
            <a href="{{ route('home') }}" style="color: #999; font-size: 12px; text-decoration: none;">
                ← Volver al inicio
            </a>
        </div>
    </div>
</div>

{{-- Limpiar el carrito al mostrar esta página --}}
@php
    session()->forget(['cart', 'metodo_entrega']);
@endphp
@endsection