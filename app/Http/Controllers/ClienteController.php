<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL', 'http://localhost:8000/api');
    }

    public function home()
    {
        return view('cliente.home');
    }
    
    public function catalogo()
    {
        return view('cliente.catalogo');
    }
    
    public function carrito()
    {
        return view('cliente.carrito');
    }

    //  PERFIL DEL CLIENTE

    public function perfil()
    {
        $user = Session::get('user');
        if (!$user) {
            return redirect()->route('login')->with('error', 'Por favor, inicia sesión.');
        }
        return view('cliente.perfil', compact('user'));
    }

    public function pedidos()
    {
        $token = Session::get('token');
        if (!$token) {
            return redirect()->route('login');
        }

        // Llamamos a la API del Backend para obtener los pedidos
        $response = Http::withToken($token)->get("{$this->apiUrl}/mis-pedidos");
        $pedidos = $response->successful() ? $response->json() : [];

        return view('cliente.pedidos', compact('pedidos'));
    }

    public function editarPerfil()
    {
        $user = Session::get('user');
        if (!$user) {
            return redirect()->route('login');
        }
        return view('cliente.editarPerfil', compact('user'));
    }

    public function updatePerfil(Request $request)
    {
        // 1. Validación
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'correo' => 'required|email|max:255',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $token = Session::get('token');
        if (!$token) {
            return redirect()->route('login')->with('error', 'Tu sesión ha expirado.');
        }

        // 2. Preparamos los datos
        $data = $request->only(['nombre', 'apellido_paterno', 'apellido_materno', 'correo']);
        if ($request->filled('password')) { 
            $data['password'] = $request->password; 
        }

    return back()->with('error', 'Error al actualizar el perfil.');
}

public function descargarAvisoPrivacidad()
{
    // Cargamos la vista que acabamos de crear en la carpeta pdf
    $pdf = Pdf::loadView('pdf.aviso-privacidaad');
    
    // Retornamos la descarga del archivo
    return $pdf->download('Aviso_Privacidad_Solare_Muebles.pdf');
}
}