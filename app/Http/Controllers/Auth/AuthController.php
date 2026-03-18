<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Mostrar el formulario de Login
     */
    public function Formulario()
    {
        return view('auth.login');
    }

    /**
     * Procesar el Inicio de Sesión (Login)
     */
    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Petición al Backend de Railway
        $response = Http::post('https://solare-backend-production.up.railway.app/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            // Guardar token y datos en sesión
            Session::put('token', $data['access_token'] ?? $data['token'] ?? '');
            Session::put('user', $data['user']);

            return redirect()->route('catalogo')->with('success', 'Bienvenido de nuevo.');
        }

        return back()->with('error', 'Credenciales incorrectas o error en el servidor.');
    }

    /**
     * Mostrar el formulario de Registro
     */
    public function Registro()
    {
        return view('auth.registro');
    }

    /**
     * Procesar el Registro con VALIDACIÓN MEJORADA
     */
    public function Register(Request $request)
    {
        // VALIDACIÓN RIGUROSA (Mayúscula, Minúscula, Número, Especial)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        // Petición al Backend de Railway
        $response = Http::post('https://solare-backend-production.up.railway.app/api/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);

        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Cuenta creada exitosamente. Ya puedes iniciar sesión.');
        }

        $errorMessage = $response->json()['message'] ?? 'Error al registrar. Reintente más tarde.';
        return back()->with('error', $errorMessage);
    }

    /**
     * Procesar el Cierre de Sesión (Logout)
     */
    public function Logout()
    {
        $token = Session::get('token');

        if ($token) {
            Http::withToken($token)->post('https://solare-backend-production.up.railway.app/api/logout');
        }

        Session::forget(['token', 'user']);
        return redirect()->route('login')->with('success', 'Sesión cerrada.');
    }
}