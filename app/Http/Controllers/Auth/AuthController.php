<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL');
    }

    public function Formulario()
    {
        return view('auth.login');
    }

    public function Login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required',
        ]);

        $response = Http::post("{$this->apiUrl}/login", [
            'correo' => $request->correo,
            'contrasena' => $request->contrasena,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            Session::put('token', $data['data']['token'] ?? '');
            Session::put('user', $data['data']['user'] ?? []);
            return redirect()->route('catalogo')->with('success', 'Bienvenido de nuevo.');
        }

        $mensaje = $response->json()['mensaje'] ?? 'Credenciales incorrectas.';
        return back()->with('error', $mensaje);
    }

    public function Registro()
    {
        return view('auth.registro');
    }

    public function Register(Request $request)
    {
        // VALIDACIÓN CON TUS NOMBRES DE COLUMNA REALES
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'correo' => 'required|string|email|max:100',
            'contrasena' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        // Petición al Backend enviando exactamente lo que pide el modelo Usuario
        $response = Http::post("{$this->apiUrl}/register", [
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'correo' => $request->correo,
            'contrasena' => $request->contrasena,
            'rol_id' => 3, // Forzamos el ID de Cliente según tu tabla de roles
        ]);

        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Cuenta creada exitosamente. Ya puedes iniciar sesión.');
        }

        $mensaje = $response->json()['mensaje'] ?? 'Error al registrar.';
        return back()->with('error', $mensaje);
    }

    public function Logout()
    {
        $token = Session::get('token');
        if ($token) {
            Http::withToken($token)->post("{$this->apiUrl}/logout");
        }
        Session::forget(['token', 'user']);
        return redirect()->route('login')->with('success', 'Sesión cerrada.');
    }
}