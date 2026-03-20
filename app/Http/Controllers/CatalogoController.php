<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CatalogoController extends Controller
{
    protected $apiUrl;
    public function __construct()
    {
        $this->apiUrl = env('API_URL', 'http://localhost:8000/api');
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
     * Muestra el catálogo de muebles con filtros funcionales y URL de Railway.
     */
    public function index(Request $request)
    {
        // 1. Capturamos los valores de la URL
        $search = $request->query('search');
        $categoria_id = $request->query('categoria_id', 'TODOS');

        // 2. Preparamos los parámetros para la API del Backend
        $params = [];
        
        if ($search) {
            $params['search'] = $search;
        }

        // Si es 'TODOS', no enviamos el filtro para que el backend traiga todo
        if ($categoria_id !== 'TODOS' && $categoria_id !== null) {
            $params['categoria_id'] = $categoria_id;
        }

        // 3. Petición al Backend en Railway
        $responseProductos = Http::get($this->apiUrl . '/productos', $params);
        $responseCategorias = Http::get($this->apiUrl . '/categorias');

        $muebles = $responseProductos->successful() ? $responseProductos->json() : [];
        //dd($muebles);
        $categorias = $responseCategorias->successful() ? $responseCategorias->json() : [];

        // 4. Enviamos a la vista con todas las variables necesarias
        return view('cliente.catalogo', compact('muebles', 'categorias', 'categoria_id', 'search'));
    }
}
