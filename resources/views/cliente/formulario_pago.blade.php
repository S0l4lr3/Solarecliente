@extends('layouts.cliente')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Columna izquierda: Formulario de datos -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Datos de Envío</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('cliente.procesar.pedido') }}" method="POST" id="formularioPago">
                        @csrf
                        
                        <!-- Datos personales -->
                        <h5 class="mb-3">Información personal</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre completo *</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" name="nombre" value="{{ old('nombre', auth()->user()->name ?? '') }}" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Correo electrónico *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono *</label>
                                <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                                       id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Dirección de envío -->
                        <h5 class="mb-3 mt-4">Dirección de envío</h5>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="calle" class="form-label">Calle y número *</label>
                                <input type="text" class="form-control @error('calle') is-invalid @enderror" 
                                       id="calle" name="calle" value="{{ old('calle') }}" required>
                                @error('calle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="colonia" class="form-label">Colonia *</label>
                                <input type="text" class="form-control @error('colonia') is-invalid @enderror" 
                                       id="colonia" name="colonia" value="{{ old('colonia') }}" required>
                                @error('colonia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="ciudad" class="form-label">Ciudad *</label>
                                <input type="text" class="form-control @error('ciudad') is-invalid @enderror" 
                                       id="ciudad" name="ciudad" value="{{ old('ciudad') }}" required>
                                @error('ciudad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="estado" class="form-label">Estado *</label>
                                <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                    <option value="">Selecciona un estado</option>
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
                                @error('estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="cp" class="form-label">Código Postal *</label>
                                <input type="text" class="form-control @error('cp') is-invalid @enderror" 
                                       id="cp" name="cp" value="{{ old('cp') }}" maxlength="5" required>
                                @error('cp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Método de pago -->
                        <h5 class="mb-3 mt-4">Método de pago</h5>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="metodo_pago" id="pago_tarjeta" value="tarjeta" checked>
                                    <label class="form-check-label" for="pago_tarjeta">
                                        <i class="fas fa-credit-card"></i> Tarjeta de crédito/débito
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="metodo_pago" id="pago_efectivo" value="efectivo">
                                    <label class="form-check-label" for="pago_efectivo">
                                        <i class="fas fa-money-bill"></i> Efectivo (Pago contra entrega)
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="metodo_pago" id="pago_transferencia" value="transferencia">
                                    <label class="form-check-label" for="pago_transferencia">
                                        <i class="fas fa-university"></i> Transferencia bancaria
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Notas adicionales -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="notas" class="form-label">Notas adicionales (opcional)</label>
                                <textarea class="form-control" id="notas" name="notas" rows="3">{{ old('notas') }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Columna derecha: Resumen del pedido (con el estilo del carrito) -->
        <div class="col-md-4">
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Resumen del pedido</h4>
                </div>
                <div class="card-body">
                    <!-- Lista de productos -->
                    <div class="mb-3">
                        <h6>Productos ({{ count($cart) }})</h6>
                        <div class="small">
                            @foreach($cart as $item)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $item['nombre'] }} x{{ $item['cantidad'] }}</span>
                                    <span>${{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- Totales (con el mismo estilo de tu imagen) -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <strong>{{ $calculos['subtotal_formato'] }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>IVA (16%)</span>
                            <strong>{{ $calculos['iva_formato'] }}</strong>
                        </div>
                        
                        <hr>
                        
                        <!-- Método de entrega seleccionado -->
                        <div class="mb-3">
                            <h6>MÉTODO DE ENTREGA:</h6>
                            @if($metodo_entrega == 'pickup')
                                <div class="d-flex justify-content-between mb-2 text-success">
                                    <div>
                                        <strong>Recoger en tienda</strong><br>
                                        <small class="text-muted">Gratis - Recoge en nuestra tienda</small>
                                    </div>
                                    <strong>Gratis</strong>
                                </div>
                            @else
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <strong>Envío a domicilio</strong><br>
                                        <small class="text-muted">Recibe en tu casa en 3-5 días hábiles</small>
                                    </div>
                                    <strong>${{ number_format($calculos['costo_entrega'], 2) }}</strong>
                                </div>
                            @endif
                        </div>
                        
                        <hr>
                        
                        <!-- Total -->
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Total</h5>
                            <h5 class="text-primary">{{ $calculos['total_formato'] }}</h5>
                        </div>
                    </div>
                    
                    <!-- Botones de acción (con el mismo estilo de tu imagen) -->
                    <div class="d-grid gap-2">
                        <button type="submit" form="formularioPago" class="btn btn-success btn-lg">
                            FINALIZAR PEDIDO
                        </button>
                        <a href="{{ route('cliente.catalogo') }}" class="btn btn-outline-secondary">
                            SEGUIR COMPRANDO
                        </a>
                    </div>
                    
                    <!-- Mensaje de seguridad -->
                    <div class="text-center mt-3 small text-muted">
                        <i class="fas fa-lock"></i> Tus datos están seguros
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border-radius: 10px;
        border: none;
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    .sticky-top {
        z-index: 100;
    }
    .form-control:focus, .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
</style>
@endpush

@push('scripts')
<script>
    // Validación básica para código postal
    document.getElementById('cp').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').substring(0, 5);
    });
    
    // Validación para teléfono
    document.getElementById('telefono').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);
    });
</script>
@endpush
@endsection