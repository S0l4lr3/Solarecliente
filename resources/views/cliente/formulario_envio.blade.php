@extends('layouts.cliente')

@section('title', 'Datos de Envío')

@section('content')
<div class="container" style="padding: 5rem 20px;">
    <h1 class="serif" style="font-size: 2.5rem; margin-bottom: 3rem; text-align: center;">Datos de Envío</h1>

    {{-- 1. CAMBIO IMPORTANTE: La acción debe ser la ruta que muestra el formulario de PAGO --}}
    <form method="POST" action="{{ route('cliente.pago') }}" id="formularioEnvio">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 4rem; align-items: start;">
            
            {{-- COLUMNA IZQUIERDA --}}
            <div>
                @if(session('error'))
                    <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; margin-bottom: 2rem; border-radius: 4px;">
                        {{ session('error') }}
                    </div>
                @endif
                
                {{-- Información de contacto --}}
                <div style="background-color: #f9f9f9; padding: 2rem; border-radius: 4px; margin-bottom: 2rem;">
                    <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 1.5rem;">Información de contacto</h3>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label style="display:block; font-size:12px; margin-bottom:5px; color:#666;">Nombre completo *</label>
                            <input type="text" name="nombre" required value="{{ old('nombre') }}" style="width:100%; padding:12px; border:1px solid #edebe8; border-radius:4px;">
                        </div>
                        <div>
                            <label style="display:block; font-size:12px; margin-bottom:5px; color:#666;">Email *</label>
                            <input type="email" name="email" required value="{{ old('email') }}" style="width:100%; padding:12px; border:1px solid #edebe8; border-radius:4px;">
                        </div>
                    </div>

                    <div>
                        <label style="display:block; font-size:12px; margin-bottom:5px; color:#666;">Teléfono *</label>
                        <input type="tel" name="telefono" id="telefono" required maxlength="10" value="{{ old('telefono') }}"
                               style="width:100%; padding:12px; border:1px solid #edebe8; border-radius:4px;">
                    </div>
                </div>

                {{-- Dirección --}}
                <div style="background-color: #f9f9f9; padding: 2rem; border-radius: 4px;">
                    <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 1.5rem;">Dirección de envío</h3>
                    
                    <div style="margin-bottom:1rem;">
                        <label style="display:block; font-size:12px; margin-bottom:5px; color:#666;">Calle *</label>
                        <input type="text" name="calle" required style="width:100%; padding:12px; border:1px solid #edebe8; border-radius:4px;">
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                        <div>
                            <label style="font-size:12px; color:#666;">Número exterior *</label>
                            <input type="text" name="numero_exterior" required style="width:100%; padding:12px; border:1px solid #edebe8; border-radius:4px;">
                        </div>
                        <div>
                            <label style="font-size:12px; color:#666;">Número interior</label>
                            <input type="text" name="numero_interior" style="width:100%; padding:12px; border:1px solid #edebe8; border-radius:4px;">
                        </div>
                    </div>

                    <div style="margin-bottom:1rem;">
                        <label style="font-size:12px; color:#666;">Colonia *</label>
                        <input type="text" name="colonia" required style="width:100%; padding:12px; border:1px solid #edebe8; border-radius:4px;">
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:1rem; margin-bottom:1rem;">
                        <div>
                            <label style="font-size:12px; color:#666;">Ciudad *</label>
                            <input type="text" name="ciudad" required style="width:100%; padding:12px; border:1px solid #edebe8; border-radius:4px;">
                        </div>
                        <div>
                            <label style="font-size:12px; color:#666;">Estado *</label>
                            <select name="estado" required style="width:100%; padding:12px; border:1px solid #edebe8; border-radius:4px; background: white;">
                                <option value="">Selecciona</option>
                                <option value="Aguascalientes">Aguascalientes</option>
                                <option value="Baja California">Baja California</option>
                                <option value="Baja California Sur">Baja California Sur</option>
                                <option value="Campeche">Campeche</option>
                                <option value="Chiapas">Chiapas</option>
                                <option value="Chihuahua">Chihuahua</option>
                                <option value="CDMX">Ciudad de México</option>
                                <option value="Coahuila">Coahuila</option>
                                <option value="Colima">Colima</option>
                                <option value="Durango">Durango</option>
                                <option value="Estado de México">Estado de México</option>
                                <option value="Guanajuato">Guanajuato</option>
                                <option value="Guerrero">Guerrero</option>
                                <option value="Hidalgo">Hidalgo</option>
                                <option value="Jalisco">Jalisco</option>
                                <option value="Michoacán">Michoacán</option>
                                <option value="Morelos">Morelos</option>
                                <option value="Nayarit">Nayarit</option>
                                <option value="Nuevo León">Nuevo León</option>
                                <option value="Oaxaca">Oaxaca</option>
                                <option value="Puebla">Puebla</option>
                                <option value="Querétaro">Querétaro</option>
                                <option value="Quintana Roo">Quintana Roo</option>
                                <option value="San Luis Potosí">San Luis Potosí</option>
                                <option value="Sinaloa">Sinaloa</option>
                                <option value="Sonora">Sonora</option>
                                <option value="Tabasco">Tabasco</option>
                                <option value="Tamaulipas">Tamaulipas</option>
                                <option value="Tlaxcala">Tlaxcala</option>
                                <option value="Veracruz">Veracruz</option>
                                <option value="Yucatán">Yucatán</option>
                                <option value="Zacatecas">Zacatecas</option>
                            </select>
                        </div>
                        <div>
                            <label style="font-size:12px; color:#666;">CP *</label>
                            <input type="text" name="codigo_postal" id="cp" required maxlength="5"
                                   style="width:100%; padding:12px; border:1px solid #edebe8; border-radius:4px;">
                        </div>
                    </div>

                    <textarea name="referencias" rows="3"
                              style="width:100%; padding:12px; border:1px solid #edebe8; border-radius:4px; resize: none;"
                              placeholder="Referencias (opcional)"></textarea>
                </div>
            </div>

            {{-- COLUMNA DERECHA (RESUMEN) --}}
            <div style="background:#f9f9f9; padding:2.5rem; border-radius:4px; position:sticky; top:20px; height: fit-content;">
                <h4 class="serif" style="margin-bottom:2rem; border-bottom:1px solid #edebe8; padding-bottom:1rem; font-size: 1.2rem;">Resumen</h4>

                @php
                    $cart = session('cart', []);
                    $subtotal = 0;
                    foreach($cart as $item) { $subtotal += $item['precio'] * $item['cantidad']; }
                    $iva = $subtotal * 0.16;
                    $envio = (session('metodo_entrega') == 'envio') ? 200 : 0;
                @endphp

                <div style="display:flex; justify-content:space-between; margin-bottom: 0.5rem; font-size: 14px;"><span>Subtotal</span><span>${{ number_format($subtotal,2) }}</span></div>
                <div style="display:flex; justify-content:space-between; margin-bottom: 0.5rem; font-size: 14px;"><span>IVA (16%)</span><span>${{ number_format($iva,2) }}</span></div>

                <div style="display:flex; justify-content:space-between; border-bottom:1px solid #edebe8; padding-bottom:1rem; font-size: 14px;">
                    <span>Envío</span>
                    <span>{{ $envio > 0 ? '$'.number_format($envio,2) : 'Gratis' }}</span>
                </div>

                <div style="display:flex; justify-content:space-between; font-weight:bold; margin:2rem 0; font-size: 1.1rem;">
                    <span>Total</span>
                    <span>${{ number_format($subtotal + $iva + $envio,2) }} MXN</span>
                </div>

                {{-- 2. CAMBIO CLAVE: El botón debe enviar el ID "formularioEnvio" --}}
                <button type="submit" form="formularioEnvio" style="width: 100%; padding: 20px; font-size: 11px; letter-spacing: 2px; background-color: #000; color: white; border: none; cursor: pointer; text-transform: uppercase; font-weight: bold;">
                    CONTINUAR AL PAGO
                </button>
                
                <div style="margin-top: 1.5rem; text-align: center;">
                    <a href="{{ route('carrito') }}" style="font-size: 10px; color: #999; text-decoration: none; text-transform: uppercase;">← Volver al carrito</a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Validación básica para el teléfono y CP
    document.getElementById('telefono').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    document.getElementById('cp').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
@endsection