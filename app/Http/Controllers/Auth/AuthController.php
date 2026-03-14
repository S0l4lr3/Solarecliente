<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de login.
     */
    public function Formulario()
    {
        return view("auth.login");
    }

    /**
     * Muestra el formulario de registro.
     */
    public function Registro()
    {
        return view("auth.registro");
    }

    /**
     * Procesa el login via API.
     */
    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $response = Http::post('https://solare-backend-production.up.railway.app/api/login', [
            'correo' => $request->email,
            'contrasena' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            session(['cliente_token' => $data['data']['token']]);
            session(['cliente_data' => $data['data']['user']]);

            return redirect('/')->with('success', 'Bienvenido a Solare Muebles para exterior.');
        }

        return back()->withErrors(['email' => 'Credenciales inválidas. Por favor, intenta de nuevo.']);
    }

    /**
     * Procesa el registro via API.
     */
    public function Register(Request $request)
    {
        // 1. Handshake con el Backend para crear el usuario
        $response = Http::post('https://solare-backend-production.up.railway.app/api/registro', [
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido,
            'correo' => $request->email,
            'contrasena' => $request->password,
            'rol_id' => 3 // Forzamos el rol de Cliente
        ]);

        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Cuenta creada. Ya puedes iniciar sesión.');
        }

        $errorMensaje = $response->json()['mensaje'] ?? 'No se pudo procesar la solicitud de acceso.';
        return back()->withErrors(['email' => $errorMensaje]);
    }

    /**
     * Cierra la sesión.
     */
    public function Logout()
    {
        $token = session('cliente_token');
        if ($token) {
            Http::withToken($token)->post('https://solare-backend-production.up.railway.app/api/logout');
        }

        Session::forget(['cliente_token', 'cliente_data', 'cart']);
        return redirect()->route('login');
    }
}
