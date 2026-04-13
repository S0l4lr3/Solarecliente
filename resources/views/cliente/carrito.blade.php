@extends('layouts.cliente')

@section('title', 'Tu Selección | Carrito')

@section('content')
<div class="container" style="padding: 5rem 20px;">
    <h1 class="serif" style="font-size: 2.5rem; margin-bottom: 3rem; text-align: center;">Tu Carrito</h1>

    @if(session('error'))
        <div style="background-color: #fde8e8; color: #9b1c1c; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; text-align: center; font-size: 13px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div style="background-color: #f0f3ef; color: #50594e; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; text-align: center; font-size: 13px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
        <div style="display: grid; grid-template-columns: 1fr 380px; gap: 4rem;">
            
            {{-- Listado de Productos --}}
            <div style="border-top: 1px solid #edebe8;">
                @foreach($cart as $id => $details)
                    <div style="display: grid; grid-template-columns: 120px 1fr 120px 100px 40px; gap: 2rem; padding: 2rem 0; border-bottom: 1px solid #edebe8; align-items: center;">
                        <img src="{{ $details['imagen'] }}" style="width: 120px; height: 120px; object-fit: cover; border-radius: 4px;">
                        
                        <div>
                            <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 5px;">{{ $details['nombre'] }}</h3>
                            <p style="font-size: 10px; color: #999; text-transform: uppercase; letter-spacing: 1px;">
                                Precio unitario: ${{ number_format($details['precio'], 2) }}
                            </p>
                        </div>

                        {{-- Control de Cantidad (+/-) --}}
                        <div style="display: flex; align-items: center; gap: 15px; background: #f9f9f9; padding: 10px; border-radius: 30px; width: fit-content; border: 1px solid #eee;">
                            <form action="{{ route('carrito.decrement') }}" method="POST" style="margin: 0;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" style="background: none; border: none; cursor: pointer; font-size: 18px; color: #958174; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; font-weight: bold;">-</button>
                            </form>
                            
                            <span style="font-size: 14px; font-weight: bold; min-width: 20px; text-align: center;">{{ $details['cantidad'] }}</span>
                            
                            <form action="{{ route('carrito.increment') }}" method="POST" style="margin: 0;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" style="background: none; border: none; cursor: pointer; font-size: 18px; color: #958174; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; font-weight: bold;">+</button>
                            </form>
                        </div>

                        <div style="font-weight: 600; text-align: right;">
                            ${{ number_format($details['precio'] * $details['cantidad'], 2) }}
                        </div>

                        <form action="{{ route('carrito.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" style="background: none; border: none; color: #999; cursor: pointer; font-size: 1.2rem; transition: color 0.3s;" onmouseover="this.style.color='#9b1c1c'" onmouseout="this.style.color='#999'">×</button>
                        </form>
                    </div>
                @endforeach
            </div>

            {{-- Resumen de Compra --}}
            <div style="background-color: #fcfaf7; padding: 2.5rem; border-radius: 8px; height: fit-content; border: 1px solid #edebe8; shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <h4 class="serif" style="font-size: 1.4rem; margin-bottom: 2rem; border-bottom: 1px solid #edebe8; padding-bottom: 1rem;">Resumen de Compra</h4>
                
                {{-- Desglose de Totales --}}
                <div style="margin-bottom: 2rem;">
                    <div style="display: flex; justify-content: space-between; font-size: 14px; color: #666; margin-bottom: 12px;">
                        <span>Mercancía</span>
                        <span>{{ $calculos['subtotal_formato'] }}</span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; font-size: 14px; color: #666;">
                        <span>IVA (16%)</span>
                        <span>{{ $calculos['iva_formato'] }}</span>
                    </div>
                </div>
                
                {{-- Método de Entrega --}}
                <div style="margin-bottom: 2.5rem; border-top: 1px solid #edebe8; padding-top: 1.5rem;">
                    <p style="font-size: 11px; color: #333; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 2px; font-weight: bold;">
                        Opciones de entrega:
                    </p>
                    
                    <label id="label-pickup" style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px; padding: 15px; border: 1px solid {{ $metodo_entrega == 'pickup' ? '#50594e' : '#edebe8' }}; border-radius: 6px; cursor: pointer; background-color: {{ $metodo_entrega == 'pickup' ? '#f0f3ef' : 'white' }}; transition: all 0.3s;">
                        <input type="radio" name="metodo_entrega" value="pickup" {{ $metodo_entrega == 'pickup' ? 'checked' : '' }} onchange="updateMetodoEntrega('pickup')" style="accent-color: #50594e;">
                        <div style="flex: 1;">
                            <div style="font-weight: 600; font-size: 13px;">Recoger en sucursal</div>
                            <div style="font-size: 10px; color: #999; text-transform: uppercase;">Gratis</div>
                        </div>
                    </label>

                    <label id="label-envio" style="display: flex; align-items: center; gap: 12px; padding: 15px; border: 1px solid {{ $metodo_entrega == 'envio' ? '#50594e' : '#edebe8' }}; border-radius: 6px; cursor: pointer; background-color: {{ $metodo_entrega == 'envio' ? '#f0f3ef' : 'white' }}; transition: all 0.3s;">
                        <input type="radio" name="metodo_entrega" value="envio" {{ $metodo_entrega == 'envio' ? 'checked' : '' }} onchange="updateMetodoEntrega('envio')" style="accent-color: #50594e;">
                        <div style="flex: 1;">
                            <div style="font-weight: 600; font-size: 13px;">Entrega a domicilio</div>
                            <div style="font-size: 10px; color: #999; text-transform: uppercase;">$200.00 MXN</div>
                        </div>
                    </label>
                </div>

                {{-- Total Final --}}
                <div style="display: flex; justify-content: space-between; margin-bottom: 2.5rem; font-size: 1.5rem; border-top: 2px solid #333; padding-top: 1.5rem;">
                    <span class="serif">Total</span>
                    <span id="totalDisplay" style="font-weight: bold; color: #333;">{{ $calculos['total_formato'] }}</span>
                </div>

                <form action="{{ route('carrito.realizarCompra') }}" method="GET">
                    <input type="hidden" name="metodo_entrega" id="metodoEntregaInput" value="{{ $metodo_entrega }}">
                    <button type="submit" class="btn-solare" style="width: 100%; background-color: #50594e; color: white; border: none; padding: 22px; font-size: 12px; font-weight: bold; letter-spacing: 3px; cursor: pointer; border-radius: 4px; transition: background 0.3s;" onmouseover="this.style.backgroundColor='#3d453c'" onmouseout="this.style.backgroundColor='#50594e'">
                        CONTINUAR AL PAGO
                    </button>
                </form>
                
                <div style="margin-top: 2rem; text-align: center;">
                    <a href="/catalogo" style="font-size: 11px; color: #958174; text-transform: uppercase; text-decoration: none; letter-spacing: 2px; font-weight: bold;">← Seguir explorando</a>
                </div>
            </div>
        </div>

        <script>
        function updateMetodoEntrega(metodo) {
            document.getElementById('metodoEntregaInput').value = metodo;
            
            // Efecto visual instantáneo de selección (Bordes y Fondos)
            const pickup = document.getElementById('label-pickup');
            const envio = document.getElementById('label-envio');
            
            if(metodo === 'pickup') {
                pickup.style.borderColor = '#50594e';
                pickup.style.backgroundColor = '#f0f3ef';
                envio.style.borderColor = '#edebe8';
                envio.style.backgroundColor = 'white';
            } else {
                envio.style.borderColor = '#50594e';
                envio.style.backgroundColor = '#f0f3ef';
                pickup.style.borderColor = '#edebe8';
                pickup.style.backgroundColor = 'white';
            }

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
        <div style="text-align: center; padding: 8rem 0;">
            <p class="serif" style="font-size: 1.8rem; opacity: 0.3; margin-bottom: 2.5rem;">Aún no has seleccionado ninguna pieza.</p>
            <a href="/catalogo" class="btn btn-primary" style="padding: 15px 40px; font-size: 11px; letter-spacing: 2px;">VER COLECCIÓN</a>
        </div>
    @endif
</div>
@endsection
