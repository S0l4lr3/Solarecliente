<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CatalogoController extends Controller
{
    /**
     * Muestra la página de inicio con productos destacados.
     */
    public function home()
    {
        $response = Http::get('https://solare-backend-production.up.railway.app/api/productos');
        $muebles = $response->successful() ? array_slice($response->json(), 0, 4) : [];
        return view('cliente.home', compact('muebles'));
    }

    /**
     * Muestra el catálogo de muebles de exterior para los clientes.
     */
    public function index(Request $request)
    {
        // 1. Capturamos el filtro de red
        $tipo = $request->query('tipo', 'TODOS');

        // 2. Petición al Nodo Central enviando el filtro
        $response = Http::get('https://solare-backend-production.up.railway.app/api/productos', [
            'tipo' => $tipo
        ]);

        if ($response->successful()) {
            $muebles = $response->json();
            return view('cliente.catalogo', compact('muebles', 'tipo'));
        }

        return view('cliente.catalogo', ['muebles' => [], 'tipo' => $tipo]);
    }
}
