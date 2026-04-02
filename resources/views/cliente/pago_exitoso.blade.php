@extends('layouts.cliente')

@section('content')
<div class="container" style="padding: 10rem 20px; text-align: center;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; padding: 4rem; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <div style="color: #28a745; font-size: 5rem; margin-bottom: 2rem;">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 class="serif" style="font-size: 2.5rem; margin-bottom: 1.5rem;">¡Pago Confirmado!</h1>
        <p style="color: #666; font-size: 1.1rem; line-height: 1.6; margin-bottom: 3rem;">
            Tu pedido ha sido procesado con éxito. Ahora se encuentra <strong>En ejecución</strong> y nuestro equipo está trabajando en él.
        </p>
        <a href="{{ route('catalogo') }}" class="btn btn-primary" style="padding: 15px 40px; text-decoration: none;">
            VOLVER AL CATÁLOGO
        </a>
    </div>
</div>
@endsection
