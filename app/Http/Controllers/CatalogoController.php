<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CatalogoController extends Controller
{
    protected $apiUrl;
    public function __construct()
    {
        $this->apiUrl = rtrim(env('API_URL', 'http://127.0.0.1:8000/api'), '/');  
    }

    /**
     * Muestra la página de inicio con productos destacados.
     */
    public function home()
    {
        $response = Http::get($this->apiUrl . '/productos');
        $muebles = $response->successful() ? array_slice($response->json(), 0, 4) : [];
        
        return view('cliente.home', compact('muebles'));
    }

    /**
     * Muestra el catálogo de muebles con filtros funcionales.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoria_id = $request->query('categoria_id', 'TODOS');

        $params = [];
        if ($search) $params['search'] = $search;
        if ($categoria_id !== 'TODOS' && $categoria_id !== null) $params['categoria_id'] = $categoria_id;

        $responseProductos = Http::get($this->apiUrl . '/productos', $params);
        $responseCategorias = Http::get($this->apiUrl . '/categorias');

        // El backend devuelve un ARRAY directo de productos
        $muebles = $responseProductos->successful() ? $responseProductos->json() : [];
        $categorias = $responseCategorias->successful() ? $responseCategorias->json() : [];

        // 4. Enviamos a la vista. La vista debe usar 'full_image_url' que viene del backend.
        return view('cliente.catalogo', compact('muebles', 'categorias', 'categoria_id', 'search'));
    }
}
