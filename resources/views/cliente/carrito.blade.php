@extends('layouts.cliente')

@section('title', 'Tu Selección | Carrito')

@section('content')
<div class="container" style="padding: 5rem 20px;">
    <h1 class="serif" style="font-size: 2.5rem; margin-bottom: 3rem; text-align: center;">Tu Carrito</h1>

    @if(count($cart) > 0)
        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 4rem;">
            
            {{-- Listado de Productos --}}
            <div style="border-top: 1px solid #edebe8;">
                @php $total = 0; @endphp
                @foreach($cart as $id => $details)
                    @php $total += $details['precio'] * $details['cantidad']; @endphp
                    <div style="display: grid; grid-template-columns: 120px 1fr 100px 50px; gap: 2rem; padding: 2rem 0; border-bottom: 1px solid #edebe8; align-items: center;">
                        <img src="{{ $details['imagen'] }}" style="width: 120px; height: 120px; object-fit: cover;">
                        
                        <div>
                            <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 5px;">{{ $details['nombre'] }}</h3>
                            <p style="font-size: 10px; color: #999; text-transform: uppercase;">Cantidad: {{ $details['cantidad'] }}</p>
                        </div>

                        <div style="font-weight: 600;">
                            ${{ number_format($details['precio'], 2) }}
                        </div>

                        <form action="{{ route('carrito.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" style="background: none; border: none; color: #958174; cursor: pointer; font-size: 1.2rem;">×</button>
                        </form>
                    </div>
                @endforeach
            </div>

            {{-- Resumen de Compra --}}
            <div style="background-color: #f9f9f9; padding: 2.5rem; border-radius: 4px; height: fit-content;">
                <h4 class="serif" style="font-size: 1.2rem; margin-bottom: 2rem; border-bottom: 1px solid #edebe8; padding-bottom: 1rem;">Resumen</h4>
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 14px;">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; font-size: 14px;">
                    <span>Envío</span>
                    <span style="font-size: 10px; text-transform: uppercase; color: #798273; font-weight: bold;">Calculado al checkout</span>
                </div>

                <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; font-size: 1.2rem; font-weight: bold; border-top: 1px solid #edebe8; padding-top: 1.5rem;">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }} MXN</span>
                </div>

                <button class="btn btn-primary" style="width: 100%; padding: 20px; font-size: 11px; letter-spacing: 2px;">
                    FINALIZAR PEDIDO
                </button>
                
                <div style="margin-top: 1.5rem; text-align: center;">
                    <a href="/catalogo" style="font-size: 10px; color: #999; text-transform: uppercase; text-decoration: none; letter-spacing: 1px;">Seguir Comprando</a>
                </div>
            </div>
        </div>
    @else
        <div style="text-align: center; padding: 5rem 0;">
            <p class="serif" style="font-size: 1.5rem; opacity: 0.4; margin-bottom: 2rem;">Tu carrito está vacío.</p>
            <a href="/catalogo" class="btn btn-primary">Ver Colección</a>
        </div>
    @endif
</div>
@endsection
