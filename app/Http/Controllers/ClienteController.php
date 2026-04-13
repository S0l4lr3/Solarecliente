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
        $this->apiUrl = rtrim(env('API_URL', 'http://localhost:8000/api'), '/');
    }

    public function profile()
    {
        $token = Session::get('token');
        if (!$token) return redirect()->route('login');

        try {
            $response = Http::withToken($token)->get("{$this->apiUrl}/perfil");
            if ($response->successful()) {
                $data = $response->json();
                $user = $data['user'];
                $direcciones = $data['direcciones'] ?? [];
                Session::put('user', $user);
                return view('cliente.perfil', compact('user', 'direcciones'));
            }
        } catch (\Exception $e) {}

        return redirect()->route('login')->with('error', 'Error al cargar el perfil.');
    }

    public function editarPerfil()
    {
        $user = Session::get('user');
        if (!$user) return redirect()->route('login');
        return view('cliente.editarPerfil', compact('user'));
    }

    public function updatePerfil(Request $request)
    {
        $token = Session::get('token');
        $data = $request->only(['nombre', 'apellido_paterno', 'apellido_materno', 'correo']);

        try {
            $response = Http::withToken($token)->put("{$this->apiUrl}/perfil/update", $data);
            if ($response->successful()) {
                Session::put('user', $response->json()['user']);
                return redirect()->route('cliente.perfil')->with('success', 'Perfil actualizado.');
            }
        } catch (\Exception $e) {}

        return back()->with('error', 'No se pudo actualizar el perfil.');
    }

    public function direccion()
    {
        $user = Session::get('user');
        if (!$user) return redirect()->route('login');
        return view('cliente.direccion', compact('user'));
    }

    public function updateDireccion(Request $request)
    {
        $token = Session::get('token');
        try {
            $response = Http::withToken($token)->post("{$this->apiUrl}/perfil/direcciones", $request->all());
            if ($response->successful()) {
                return redirect()->route('cliente.perfil')->with('success', 'Dirección guardada.');
            }
        } catch (\Exception $e) {}

        return back()->with('error', 'Error al guardar dirección.');
    }

    public function eliminarDireccion($id)
    {
        $token = Session::get('token');
        Http::withToken($token)->delete("{$this->apiUrl}/perfil/direcciones/{$id}");
        return back()->with('success', 'Dirección eliminada.');
    }

    public function pedidos()
    {
        $token = Session::get('token');
        if (!$token) return redirect()->route('login');
        $response = Http::withToken($token)->get("{$this->apiUrl}/mis-pedidos");
        $pedidos = $response->successful() ? $response->json() : [];
        return view('cliente.pedidos', compact('pedidos'));
    }

    public function cancelarPedido($id)
    {
        $token = Session::get('token');
        if (!$token) return redirect()->route('login');

        try {
            $response = Http::withToken($token)->post("{$this->apiUrl}/pedidos/{$id}/cancelar");
            
            if ($response->successful()) {
                return back()->with('success', 'Pedido cancelado correctamente y stock devuelto.');
            }
            
            $mensaje = $response->json()['mensaje'] ?? 'No se pudo cancelar el pedido.';
            return back()->with('error', $mensaje);
        } catch (\Exception $e) {
            return back()->with('error', 'Error de conexión al intentar cancelar.');
        }
    }
}
