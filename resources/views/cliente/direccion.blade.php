@extends('layouts.cliente')

@section('title', 'Gestionar Dirección')

@section('content')

<div class="container" style="margin-top: 5rem; margin-bottom: 7rem;">
    <div style="max-width: 800px; margin: 0 auto;">
        
        {{-- Encabezado --}}
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 4rem; border-bottom: 1px solid var(--color-sand-beige); padding-bottom: 2rem;">
            <div>
                <h1 class="serif" style="font-size: 3.5rem; color: var(--color-dark-moss); margin-bottom: 1rem;">Dirección de Envío</h1>
                <p style="font-size: 19px; text-transform: uppercase; letter-spacing: 2px; color: var(--color-clay-brown); font-weight: 700;">Establece tu hoja de ruta para entregas</p>
            </div>
            <a href="{{ route('cliente.perfil') }}" style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px; color: #999; text-decoration: none; font-weight: 700;">← Volver al Perfil</a>
        </div>

        {{-- Mensajes de Alerta --}}
        @if(session('success'))
            <div style="background-color: #f0fdf4; color: #166534; padding: 20px; border-radius: 4px; margin-bottom: 3rem; font-size: 16px; border: 1px solid #bbf7d0;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('cliente.direccion.update') }}" method="POST" style="background-color: #fcfaf7; padding: 4rem; border-radius: 4px; border: 1px solid #95817422;">
            @csrf
            @method('POST')

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 2.5rem; margin-bottom: 2.5rem;">
                <div style="grid-column: span 3;">
                    <label style="display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #958174;">Alias de la Dirección (Ej. Casa, Oficina)</label>
                    <input type="text" name="alias" placeholder="Ej. Casa Principal"
                           style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #ffffff;" required>
                </div>

                <div style="grid-column: span 1;">
                    <label style="display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #958174;">Calle</label>
                    <input type="text" name="calle" placeholder="Ej. Av. Paseo de los Leones"
                           style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #ffffff;" required>
                </div>

                <div>
                    <label style="display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #958174;">Número Exterior</label>
                    <input type="text" name="numero_exterior" placeholder="Ej. 123"
                           style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #ffffff;" required>
                </div>

                <div>
                    <label style="display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #958174;">Número Interior (Opcional)</label>
                    <input type="text" name="numero_interior" placeholder="Ej. Depto 4"
                           style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #ffffff;">
                </div>

                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #958174;">Colonia / Fraccionamiento</label>
                    <input type="text" name="colonia" placeholder="Ej. Valle Verde"
                           style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #ffffff;" required>
                </div>

                <div>
                    <label style="display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #958174;">Código Postal</label>
                    <input type="text" name="codigo_postal" placeholder="5 dígitos" maxlength="5"
                           style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #ffffff;" required>
                </div>

                <div>
                    <label style="display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #958174;">Ciudad</label>
                    <input type="text" name="ciudad" placeholder="Ej. Guadalajara"
                           style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #ffffff;" required>
                </div>

                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #958174;">Estado</label>
                    <select name="estado" style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 18px; outline: none; background: #ffffff; cursor: pointer;">
                        <option value="Jalisco">Jalisco</option>
                        <option value="Ciudad de México">Ciudad de México</option>
                        <option value="Nuevo León">Nuevo León</option>
                        <option value="México">Estado de México</option>
                        <option value="Querétaro">Querétaro</option>
                    </select>
                </div>

                <div style="grid-column: span 3;">
                    <label style="display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1rem; color: #958174;">Referencias Adicionales (Opcional)</label>
                    <textarea name="referencias" rows="3" placeholder="Ej. Portón café, frente al parque..."
                              style="width: 100%; padding: 15px; border: 1px solid var(--color-sand-beige); font-size: 16px; outline: none; background: #ffffff;"></textarea>
                </div>
            </div>

            <div style="text-align: center; border-top: 1px solid #edebe8; padding-top: 3rem;">
                <button type="submit" class="btn btn-primary" style="padding: 20px 60px; font-size: 14px; width: auto; display: inline-block;">Guardar Dirección de Envío</button>
            </div>
        </form>

    </div>
</div>

@endsection
