@extends('layouts.cliente')

@section('title', 'Datos de Envío')

@section('content')
<div class="container" style="padding: 5rem 20px;">
    <h1 class="serif" style="font-size: 2rem; margin-bottom: 2rem; text-align: center;">Datos de Envío</h1>

    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 4rem;">
        
        {{-- Formulario de Envío --}}
        <div>
            @if(session('error'))
                <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; margin-bottom: 2rem; border-radius: 4px;">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('cliente.pago') }}" id="formularioEnvio">
                @csrf
                
                {{-- Datos personales --}}
                <div style="background-color: #f9f9f9; padding: 2rem; border-radius: 4px; margin-bottom: 2rem;">
                    <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 1.5rem;">Información de contacto</h3>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Nombre completo *</label>
                            <input type="text" name="nombre" required 
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Email *</label>
                            <input type="email" name="email" required 
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                        </div>
                    </div>

                    <div>
                        <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Teléfono *</label>
                        <input type="tel" name="telefono" id="telefono" required maxlength="10"
                               style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                    </div>
                </div>

                {{-- Dirección --}}
                <div style="background-color: #f9f9f9; padding: 2rem; border-radius: 4px;">
                    <h3 class="serif" style="font-size: 1.2rem; margin-bottom: 1.5rem;">Dirección de envío</h3>
                    
                    {{-- Calle --}}
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Calle *</label>
                        <input type="text" name="calle" required 
                               style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                    </div>

                    {{-- Número exterior e interior --}}
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Número exterior *</label>
                            <input type="text" name="numero_exterior" required 
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Número interior</label>
                            <input type="text" name="numero_interior" 
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                            <span style="font-size: 10px; color: #999;">Opcional</span>
                        </div>
                    </div>

                    {{-- Colonia --}}
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Colonia *</label>
                        <input type="text" name="colonia" required 
                               style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                    </div>

                    {{-- Ciudad, Estado, Código Postal --}}
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Ciudad *</label>
                            <input type="text" name="ciudad" required 
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Estado *</label>
                            <select name="estado" required style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
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
                            <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Código Postal *</label>
                            <input type="text" name="codigo_postal" id="cp" required maxlength="5"
                                   style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;">
                        </div>
                    </div>

                    {{-- País (oculto con valor por defecto) --}}
                    <input type="hidden" name="pais" value="México">

                    {{-- Referencias --}}
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; font-size: 12px; margin-bottom: 5px; color: #666;">Referencias</label>
                        <textarea name="referencias" rows="3" style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 4px;" placeholder="Entre calles, puntos de referencia, etc. (opcional)"></textarea>
                        <span style="font-size: 10px; color: #999;">Opcional</span>
                    </div>

                    {{-- Checkbox para dirección principal --}}
                    <div style="margin-top: 1rem;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="es_principal" value="1" checked style="cursor: pointer;">
                            <span style="font-size: 12px;">Establecer como mi dirección principal</span>
                        </label>
                    </div>
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

            <button type="submit" form="formularioEnvio" class="btn btn-primary" style="width: 100%; padding: 20px; font-size: 11px; border: none; cursor: pointer;">
                CONTINUAR AL PAGO
            </button>
            
            <div style="margin-top: 1.5rem; text-align: center;">
                <a href="{{ route('carrito') }}" style="font-size: 10px; color: #999; text-decoration: none;">← Volver al carrito</a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('telefono').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);
});

document.getElementById('cp').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '').substring(0, 5);
});

// Validación antes de enviar
document.getElementById('formularioEnvio').addEventListener('submit', function(e) {
    let nombre = document.querySelector('input[name="nombre"]').value;
    let email = document.querySelector('input[name="email"]').value;
    let telefono = document.getElementById('telefono').value;
    let calle = document.querySelector('input[name="calle"]').value;
    let numero_exterior = document.querySelector('input[name="numero_exterior"]').value;
    let colonia = document.querySelector('input[name="colonia"]').value;
    let ciudad = document.querySelector('input[name="ciudad"]').value;
    let estado = document.querySelector('select[name="estado"]').value;
    let cp = document.getElementById('cp').value;

    // Campos obligatorios
    if (!nombre || !email || !telefono || !calle || !numero_exterior || !colonia || !ciudad || !estado || !cp) {
        e.preventDefault();
        alert('Todos los campos marcados con * son obligatorios');
        return false;
    }

    if (telefono.length < 10) {
        e.preventDefault();
        alert('El teléfono debe tener 10 dígitos');
        return false;
    }

    if (cp.length < 5) {
        e.preventDefault();
        alert('El código postal debe tener 5 dígitos');
        return false;
    }
});
</script>
@endsection