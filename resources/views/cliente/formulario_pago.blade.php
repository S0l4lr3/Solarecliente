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

            <form method="POST" action="{{ route('carrito.procesar') }}" id="formularioPago">
                @csrf
                
                {{-- Datos personales --}}
                <div style="background-color: #f9f9f9; padding: 2rem; border-radius: 4px; margin-bottom: 2rem;">
                    <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 1.5rem;">Confirmar información</h3>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Nombre completo *</label>
                            <input type="text" name="nombre" required value="{{ old('nombre', session('user.nombre') ?? '') }}"
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Email *</label>
                            <input type="email" name="email" required value="{{ old('email', session('user.correo') ?? '') }}"
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                        </div>
                    </div>

                    <div>
                        <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Teléfono *</label>
                        <input type="tel" name="telefono" id="telefono" 
                               style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                    </div>
                </div>

                {{-- Método de pago --}}
                <div style="background-color: #f9f9f9; padding: 2rem; border-radius: 4px; margin-bottom: 2rem;">
                    <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 1.5rem;">Método de pago</h3>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 15px; padding: 15px; border: 1px solid #edebe8; border-radius: 4px; cursor: pointer; transition: all 0.3s; background: #fff;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <input type="radio" name="metodo_pago" value="paypal" checked style="cursor: pointer;">
                                <span style="font-weight: 500;">PayPal (Saldo, Tarjetas o Crédito)</span>
                            </div>
                            <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg" alt="PayPal Logo" style="height: 23px;">
                        </label>

                        <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; padding: 15px; border: 1px solid #edebe8; border-radius: 4px; cursor: pointer; background: #fff;">
                            <input type="radio" name="metodo_pago" value="efectivo" style="cursor: pointer;">
                            <span>Efectivo (Pago contra entrega)</span>
                        </label>
                    </div>
                </div>

                {{-- Notas --}}
                <div style="background-color: #f9f9f9; padding: 2rem; border-radius: 4px; margin-bottom: 2rem;">
                    <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 1.5rem;">Notas adicionales</h3>
                    <textarea name="notas" rows="4" style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;" placeholder="¿Algo que debamos saber? (opcional)"></textarea>
                </div>

                {{-- Dirección de Envío (Solo si es entrega a domicilio) --}}
                @if(session('metodo_entrega') === 'envio')
                <div style="background-color: #fcfaf7; padding: 2rem; border-radius: 4px; border: 1px solid #95817433;">
                    <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 1.5rem; color: #958174;">Dirección de Envío</h3>
                    
                    {{-- SELECTOR DE DIRECCIONES GUARDADAS --}}
                    @if(count($direcciones) > 0)
                    <div style="margin-bottom: 2rem; padding: 1.5rem; background: #fff; border: 1px solid #95817455; border-radius: 4px;">
                        <label style="display: block; font-size: 11px; font-weight: bold; text-transform: uppercase; margin-bottom: 10px; color: #958174;">Usar una dirección guardada</label>
                        <input type="hidden" name="direccion_envio_id" id="direccion_envio_id">
                        <select id="selectorDireccion" style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px; background: white; cursor: pointer;">
                            <option value="">-- Seleccionar dirección --</option>
                            @foreach($direcciones as $dir)
                                <option value="{{ $dir['id'] }}" 
                                        data-calle="{{ $dir['calle'] }} {{ $dir['numero_exterior'] }}"
                                        data-colonia="{{ $dir['colonia'] }}"
                                        data-cp="{{ $dir['codigo_postal'] }}"
                                        data-ciudad="{{ $dir['ciudad'] }}"
                                        data-estado="{{ $dir['estado'] }}">
                                    {{ $dir['alias'] }} ({{ $dir['calle'] }} #{{ $dir['numero_exterior'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; font-size: 11px; font-weight: bold; text-transform: uppercase; margin-bottom: 5px; color: #958174;">Calle y Número *</label>
                        <input type="text" name="direccion" id="campo_direccion" required placeholder="Ej. Av. Vallarta 123 Int 4"
                               style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: bold; text-transform: uppercase; margin-bottom: 5px; color: #958174;">Colonia / Fraccionamiento *</label>
                            <input type="text" name="colonia" id="campo_colonia" required
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: bold; text-transform: uppercase; margin-bottom: 5px; color: #958174;">Código Postal *</label>
                            <input type="text" name="cp" id="campo_cp" required maxlength="5"
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: bold; text-transform: uppercase; margin-bottom: 5px; color: #958174;">Ciudad *</label>
                            <input type="text" name="ciudad" id="campo_ciudad" required
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: bold; text-transform: uppercase; margin-bottom: 5px; color: #958174;">Estado *</label>
                            <select name="estado" id="campo_estado" required style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px; background: white;">
                                <option value="Jalisco">Jalisco</option>
                                <option value="Ciudad de México">Ciudad de México</option>
                                <option value="Nuevo León">Nuevo León</option>
                                <option value="México">México</option>
                                <option value="OTRO">Otro Estado</option>
                            </select>
                        </div>
                    </div>
                </div>
                @endif
            </form>
        </div>

        <script>
            // Lógica para auto-completar dirección
            document.getElementById('selectorDireccion')?.addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                const hiddenInput = document.getElementById('direccion_envio_id');
                
                if(selected.value !== "") {
                    hiddenInput.value = selected.value; // Asignamos el ID
                    document.getElementById('campo_direccion').value = selected.getAttribute('data-calle');
                    document.getElementById('campo_colonia').value = selected.getAttribute('data-colonia');
                    document.getElementById('campo_cp').value = selected.getAttribute('data-cp');
                    document.getElementById('campo_ciudad').value = selected.getAttribute('data-ciudad');
                    document.getElementById('campo_estado').value = selected.getAttribute('data-estado');
                } else {
                    hiddenInput.value = ""; // Limpiamos el ID si se elige la opción vacía
                }
            });
        </script>

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
                $costo_envio = ($metodo == 'envio') ? 200 : 0;
                $total = $subtotal + $iva + $costo_envio;
            @endphp

            <div style="max-height: 200px; overflow-y: auto; margin-bottom: 1rem;">
                @foreach($cart as $details)
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 14px;">
                        <span>{{ $details['nombre'] }} x{{ $details['cantidad'] }}</span>
                        <span>${{ number_format($details['precio'] * $details['cantidad'], 2) }}</span>
                    </div>
                @endforeach
            </div>

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

            <button type="submit" form="formularioPago" style="width: 100%; padding: 20px; font-size: 11px; letter-spacing: 2px; background-color: #000; color: white; border: none; cursor: pointer; text-transform: uppercase; font-weight: bold; margin-top: 1rem;">
                CONFIRMAR PEDIDO 
            </button>

            <div style="margin-top: 1.5rem; text-align: center;">
                <a href="{{ route('carrito') }}" style="font-size: 10px; color: #999; text-decoration: none; text-transform: uppercase;">← Volver al carrito</a>
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
        alert('Por favor, completa tus datos de contacto.');
        return false;
    }

    // Validación de Dirección (Si el bloque existe en el DOM)
    let direccionInput = document.querySelector('input[name="direccion"]');
    if (direccionInput) {
        let cp = document.getElementById('cp').value;
        let colonia = document.querySelector('input[name="colonia"]').value;
        let ciudad = document.querySelector('input[name="ciudad"]').value;

        if (!direccionInput.value || !cp || !colonia || !ciudad) {
            e.preventDefault();
            alert('La dirección de envío es obligatoria para la entrega a domicilio.');
            return false;
        }

        if (cp.length < 5) {
            e.preventDefault();
            alert('El Código Postal debe tener 5 dígitos.');
            return false;
        }
    }

    if (!metodo_pago) {
        e.preventDefault();
        alert('Selecciona un método de pago');
        return false;
    }
});
</script>
@endsection
