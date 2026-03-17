@extends('layouts.cliente')

@section('title', 'Tu Selección | Carrito')

@section('content')
<div class="container" style="padding: 5rem 20px;">
    <h1 class="serif" style="font-size: 2.5rem; margin-bottom: 3rem; text-align: center;">Tu Carrito</h1>

    @if(count($cart) > 0)
        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 4rem;">
            
            {{-- Listado de Productos --}}
            <div style="border-top: 1px solid #edebe8;">
                @foreach($cart as $id => $details)
                    <div style="display: grid; grid-template-columns: 120px 1fr 100px 50px; gap: 2rem; padding: 2rem 0; border-bottom: 1px solid #edebe8; align-items: center;">
                        <img src="{{ $details['imagen'] }}" style="width: 120px; height: 120px; object-fit: cover;">
                        
                        <div>
                            <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 5px;">{{ $details['nombre'] }}</h3>
                            <p style="font-size: 10px; color: #999; text-transform: uppercase;">
                                Cantidad: {{ $details['cantidad'] }} | 
                                Precio unitario: ${{ number_format($details['precio'], 2) }}
                            </p>
                        </div>

                        <div style="font-weight: 600;">
                            ${{ number_format($details['precio'] * $details['cantidad'], 2) }}
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
                
                {{-- Subtotal --}}
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 14px;">
                    <span>Subtotal</span>
                    <span>{{ $calculos['subtotal_formato'] }}</span>
                </div>
                
                {{-- IVA --}}
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 14px;">
                    <span>IVA (16%)</span>
                    <span>{{ $calculos['iva_formato'] }}</span>
                </div>
                
                {{-- Método de Entrega --}}
                <div style="margin-bottom: 2rem; border-bottom: 1px solid #edebe8; padding-bottom: 1rem;">
                    <p style="font-size: 12px; color: #666; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px;">
                        Método de entrega:
                    </p>
                    
                    {{-- Opción Pick Up --}}
                    <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px; padding: 10px; border: 1px solid {{ $metodo_entrega == 'pickup' ? '#798273' : '#edebe8' }}; border-radius: 4px; cursor: pointer; background-color: {{ $metodo_entrega == 'pickup' ? '#f0f3ef' : 'transparent' }};">
                        <input type="radio" 
                               name="metodo_entrega" 
                               value="pickup" 
                               {{ $metodo_entrega == 'pickup' ? 'checked' : '' }}
                               onchange="updateMetodoEntrega('pickup')"
                               style="cursor: pointer;">
                        <div style="flex: 1;">
                            <div style="font-weight: 600; margin-bottom: 3px;">Recoger en tienda</div>
                            <div style="font-size: 11px; color: #666;">Gratis - Recoge en nuestra tienda</div>
                        </div>
                        <span style="font-weight: 600; color: #798273;">Gratis</span>
                    </label>

                    {{-- Opción Envío --}}
                    <label style="display: flex; align-items: center; gap: 10px; padding: 10px; border: 1px solid {{ $metodo_entrega == 'envio' ? '#798273' : '#edebe8' }}; border-radius: 4px; cursor: pointer; background-color: {{ $metodo_entrega == 'envio' ? '#f0f3ef' : 'transparent' }};">
                        <input type="radio" 
                               name="metodo_entrega" 
                               value="envio" 
                               {{ $metodo_entrega == 'envio' ? 'checked' : '' }}
                               onchange="updateMetodoEntrega('envio')"
                               style="cursor: pointer;">
                        <div style="flex: 1;">
                            <div style="font-weight: 600; margin-bottom: 3px;">Envío a domicilio</div>
                            <div style="font-size: 11px; color: #666;">Recibe en tu casa en 3-5 días hábiles</div>
                        </div>
                        <span style="font-weight: 600;">$200.00</span>
                    </label>
                </div>

                {{-- Total --}}
                <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; font-size: 1.2rem; font-weight: bold; border-top: 1px solid #edebe8; padding-top: 1.5rem;">
                    <span>Total</span>
                    <span id="totalDisplay">{{ $calculos['total_formato'] }}</span>
                </div>

                {{-- Botón Finalizar Pedido --}}
                <form action="{{ route('carrito.procesar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="metodo_entrega" id="metodoEntregaInput" value="{{ $metodo_entrega }}">
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 20px; font-size: 11px; letter-spacing: 2px;">
                        FINALIZAR PEDIDO
                    </button>
                </form>
                
                <div style="margin-top: 1.5rem; text-align: center;">
                    <a href="/catalogo" style="font-size: 10px; color: #999; text-transform: uppercase; text-decoration: none; letter-spacing: 1px;">Seguir Comprando</a>
                </div>
            </div>
        </div>

        {{-- Script para manejar el método de entrega --}}
        <script>
        function updateMetodoEntrega(metodo) {
            document.getElementById('metodoEntregaInput').value = metodo;
            
            fetch('{{ route("carrito.update-metodo-entrega") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    metodo_entrega: metodo
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('totalDisplay').textContent = data.calculos.total_formato;
                }
            });
        }
        </script>

    @else
        <div style="text-align: center; padding: 5rem 0;">
            <p class="serif" style="font-size: 1.5rem; opacity: 0.4; margin-bottom: 2rem;">Tu carrito está vacío.</p>
            <a href="/catalogo" class="btn btn-primary">Ver Colección</a>
        </div>
    @endif
</div>
@endsection