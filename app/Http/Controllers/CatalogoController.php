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
        
        $muebles = [];
        if ($response->successful()) {
            $data = $response->json();
            // Extraemos los productos de la llave 'data' (formato paginado de Laravel)
            $listaProductos = $data['data'] ?? [];
            $muebles = array_slice($listaProductos, 0, 4);
        }
        
        return view('cliente.home', compact('muebles'));
    }

    /**
     * Muestra el catálogo de muebles con filtros funcionales.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoria_id = $request->query('categoria_id', 'TODOS');
        $page = $request->query('page', 1);

        $params = ['page' => $page];
        if ($search) $params['search'] = $search;
        if ($categoria_id !== 'TODOS' && $categoria_id !== null) $params['categoria_id'] = $categoria_id;

        $responseProductos = Http::get($this->apiUrl . '/productos', $params);
        $responseCategorias = Http::get($this->apiUrl . '/categorias');

        // El backend ahora devuelve un objeto de paginación
        $paginacion = $responseProductos->successful() ? $responseProductos->json() : ['data' => []];
        $muebles = $paginacion['data'] ?? [];
        $categorias = $responseCategorias->successful() ? $responseCategorias->json() : [];

        return view('cliente.catalogo', compact('muebles', 'categorias', 'categoria_id', 'search', 'paginacion'));
    }
}
