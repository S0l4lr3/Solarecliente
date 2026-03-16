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
        // 1. Capturamos los filtros de la URL
        $params = [
            'search' => $request->query('search'),
            'categoria_id' => $request->query('categoria_id')
        ];

        // 2. Petición al Backend con los filtros (USANDO LA URL DE RAILWAY)
        $responseProductos = Http::get('https://solare-backend-production.up.railway.app/api/productos', $params);
        $responseCategorias = Http::get('https://solare-backend-production.up.railway.app/api/categorias');

        $muebles = $responseProductos->successful() ? $responseProductos->json() : [];
        $categorias = $responseCategorias->successful() ? $responseCategorias->json() : [];

        return view('cliente.catalogo', [
            'muebles' => $muebles,
            'categorias' => $categorias,
            'search' => $params['search'],
            'categoria_id' => $params['categoria_id']
        ]);
    }
}
