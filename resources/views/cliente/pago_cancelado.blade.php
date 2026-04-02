@extends('layouts.cliente')

@section('content')
<div class="container" style="padding: 10rem 20px; text-align: center;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; padding: 4rem; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <div style="color: #dc3545; font-size: 5rem; margin-bottom: 2rem;">
            <i class="fas fa-times-circle"></i>
        </div>
        <h1 class="serif" style="font-size: 2.5rem; margin-bottom: 1.5rem;">Pago Cancelado</h1>
        <p style="color: #666; font-size: 1.1rem; line-height: 1.6; margin-bottom: 3rem;">
            El proceso de pago fue cancelado. No se ha realizado ningún cargo a tu cuenta. Puedes intentarlo de nuevo desde tu carrito.
        </p>
        <a href="{{ route('carrito') }}" class="btn btn-primary" style="padding: 15px 40px; text-decoration: none;">
            VOLVER AL CARRITO
        </a>
    </div>
</div>
@endsection
