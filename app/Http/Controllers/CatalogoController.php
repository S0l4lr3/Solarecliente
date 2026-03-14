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
        // 1. Capturamos el ID de la categoría seleccionado (por defecto 'TODOS')
        $categoria_id = $request->query('categoria_id', 'TODOS');

        // 2. Preparamos los parámetros para la API de productos
        // Si es 'TODOS', no enviamos el filtro para que traiga el catálogo completo
        $params = [];
        if ($categoria_id !== 'TODOS') {
            $params['categoria_id'] = $categoria_id;
        }

        // 3. Hacemos las peticiones a tu API (Backend)
        $responseProductos = Http::get('http://127.0.0.1:8000/api/productos', $params);
        $responseCategorias = Http::get('http://127.0.0.1:8000/api/categorias');

        // 4. Convertimos la respuesta en arrays
        $muebles = $responseProductos->successful() ? $responseProductos->json() : [];
        $categorias = $responseCategorias->successful() ? $responseCategorias->json() : [];

        // 5. Enviamos todo a la vista
        return view('cliente.catalogo', compact('muebles', 'categorias', 'categoria_id'));
    }
}
