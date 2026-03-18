@extends('layouts.cliente')

@section('title', 'Método de Pago')

@section('content')
<div class="container" style="padding: 5rem 20px;">
    <h1 class="serif" style="font-size: 2rem; margin-bottom: 2rem; text-align: center;">Método de Pago</h1>

    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 4rem;">
        
        {{-- Formulario de Pago --}}
        <div>
            @if(session('error'))
                <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; margin-bottom: 2rem; border-radius: 4px;">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('cliente.pedido.realizado') }}" id="formularioPago">
                @csrf
                
                {{-- Datos personales --}}
                <div style="background-color: #f9f9f9; padding: 2rem; border-radius: 4px; margin-bottom: 2rem;">
                    <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 1.5rem;">Confirmar información</h3>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Nombre completo *</label>
                            <input type="text" name="nombre" required value="{{ old('nombre', session('cliente_data.nombre') ?? '') }}"
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Email *</label>
                            <input type="email" name="email" required value="{{ old('email', session('cliente_data.correo') ?? '') }}"
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                        </div>
                    </div>

                    <div>
                        <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Teléfono *</label>
                        <input type="tel" name="telefono" id="telefono" required maxlength="10"
                               style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                    </div>
                </div>

                {{-- Método de pago --}}
                <div style="background-color: #f9f9f9; padding: 2rem; border-radius: 4px; margin-bottom: 2rem;">
                    <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 1.5rem;">Método de pago</h3>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; padding: 10px; border: 1px solid #edebe8; border-radius: 4px; cursor: pointer;">
                            <input type="radio" name="metodo_pago" value="tarjeta" checked style="cursor: pointer;">
                            <span>Tarjeta de crédito/débito</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; padding: 10px; border: 1px solid #edebe8; border-radius: 4px; cursor: pointer;">
                            <input type="radio" name="metodo_pago" value="efectivo" style="cursor: pointer;">
                            <span>Efectivo (Pago contra entrega)</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; padding: 10px; border: 1px solid #edebe8; border-radius: 4px; cursor: pointer;">
                            <input type="radio" name="metodo_pago" value="transferencia" style="cursor: pointer;">
                            <span>Transferencia bancaria</span>
                        </label>
                    </div>
                </div>

                {{-- Notas --}}
                <div style="background-color: #f9f9f9; padding: 2rem; border-radius: 4px;">
                    <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 1.5rem;">Notas adicionales</h3>
                    <textarea name="notas" rows="4" style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;" placeholder="¿Algo que debamos saber? (opcional)"></textarea>
                </div>
            </form>
        </div>

        {{-- Resumen del pedido --}}
        <div style="background-color: #f9f9f9; padding: 2.5rem; border-radius: 4px; height: fit-content; position: sticky; top: 20px;">
            <h4 class="serif" style="font-size: 1.2rem; margin-bottom: 2rem; border-bottom: 1px solid #edebe8; padding-bottom: 1rem;">Resumen</h4>
            
            @php
                $cart = session('cart', []);
                $metodo = session('metodo_entrega', 'pickup');
                $subtotal = 0;
                foreach($cart as $item) {
                    $subtotal += $item['precio'] * $item['cantidad'];
                }
                $iva = $subtotal * 0.16;
                $costo_envio = ($metodo == 'envio') ? 350 : 0;
                $total = $subtotal + $iva + $costo_envio;
            @endphp

            @foreach($cart as $details)
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 14px;">
                    <span>{{ $details['nombre'] }} x{{ $details['cantidad'] }}</span>
                    <span>${{ number_format($details['precio'] * $details['cantidad'], 2) }}</span>
                </div>
            @endforeach

            <div style="border-top: 1px solid #edebe8; margin: 1rem 0; padding-top: 1rem;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span>Subtotal</span>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span>IVA (16%)</span>
                    <span>${{ number_format($iva, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span>Envío</span>
                    <span>{{ $costo_envio > 0 ? '$'.number_format($costo_envio, 2) : 'Gratis' }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: bold; border-top: 1px solid #edebe8; padding-top: 1rem;">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }} MXN</span>
                </div>
            </div>

            <button type="submit" form="formularioPago" class="btn btn-primary" style="width: 100%; padding: 20px; font-size: 11px; border: none; cursor: pointer;">
                CONFIRMAR PEDIDO
            </button>
            
            <div style="margin-top: 1.5rem; text-align: center;">
                <a href="{{ $metodo == 'envio' ? route('cliente.envio') : route('carrito') }}" style="font-size: 10px; color: #999; text-decoration: none;">← Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('telefono').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);
});

// Validación antes de enviar
document.getElementById('formularioPago').addEventListener('submit', function(e) {
    let nombre = document.querySelector('input[name="nombre"]').value;
    let email = document.querySelector('input[name="email"]').value;
    let telefono = document.getElementById('telefono').value;
    let metodo_pago = document.querySelector('input[name="metodo_pago"]:checked');

    if (!nombre || !email || !telefono) {
        e.preventDefault();
        alert('Todos los campos son obligatorios');
        return false;
    }

    if (!metodo_pago) {
        e.preventDefault();
        alert('Selecciona un método de pago');
        return false;
    }

    if (telefono.length < 10) {
        e.preventDefault();
        alert('El teléfono debe tener 10 dígitos');
        return false;
    }
});
</script>
@endsection