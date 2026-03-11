@extends('layouts.cliente')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container" style="min-height: 60vh; display: flex; align-items: center; justify-content: center; padding: 3rem 0;">
    <div style="max-width: 400px; width: 100%; background: #ffffff; border: 1px solid #edebe8; border-radius: 8px; padding: 2.5rem;">
        <h1 style="color: #000000; text-align: center; margin-bottom: 2rem;">BIENVENIDO</h1>
        
        <form>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem;">Correo</label>
                <input type="email" placeholder="hola@email.com" 
                       style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 5px;">
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem;">Contraseña</label>
                <input type="password" placeholder="********" 
                       style="width: 100%; padding: 12px; border: 1px solid #edebe8; border-radius: 5px;">
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px;">INICIAR SESIÓN</button>
            
            <hr style="border-color: #edebe8; margin: 2rem 0;">
            
            <p style="text-align: center;">
                ¿No tienes cuenta? 
                <a href="{{ route('registro') }}" style="color: #958174;">REGÍSTRATE</a>
            </p>
        </form>
    </div>
</div>
@endsection