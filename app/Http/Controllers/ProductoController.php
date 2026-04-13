<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductoController extends Controller
{
    /**
     * Muestra el detalle de un mueble de exterior.
     */
    public function show($id)
    {
        $apiUrl = env('API_URL', 'http://127.0.0.1:8000/api');
        $urlCompleta = "{$apiUrl}/productos/{$id}";
        
        $response = Http::get($urlCompleta);

        if ($response->successful()) {
            $mueble = $response->json();
            
            return view('cliente.producto-detalle', compact('mueble'));
        }

        return redirect()->route('catalogo')->with('error', 'El mueble solicitado no está disponible.');
    }
}
