@extends('layouts.cliente')

@section('title', 'Registro')

@section('content')
<div class="container" style="min-height: 60vh; display: flex; align-items: center; justify-content: center; padding: 3rem 0;">
    <div style="max-width: 500px; width: 100%; background: #ffffff; border: 1px solid #edebe8; border-radius: 8px; padding: 2.5rem;">
        <h1 style="color: #000000; text-align: center; margin-bottom: 2rem;">CREAR CUENTA</h1>
        
        <form>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem;">Nombre</label>
                    <input type="text" placeholder="Juan" 
                           style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 5px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 0.5rem;">Apellido</label>
                    <input type="text" placeholder="Pérez" 
                           style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 5px;">
                </div>
            </div>
            
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem;">Correo</label>
                <input type="email" placeholder="hola@email.com" 
                       style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 5px;">
            </div>
            
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem;">Contraseña</label>
                <input type="password" placeholder="********" 
                       style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 5px;">
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; margin-bottom: 1rem;">
                REGISTRARSE
            </button>
            
            <p style="text-align: center;">
                ¿Ya tienes cuenta? 
                <a href="{{ route('login') }}" style="color: #958174;">INICIA SESIÓN</a>
            </p>
        </form>
    </div>
</div>
@endsection