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
        // 1. Petición al Nodo Central por el mueble específico
        $response = Http::get(env('API_URL') . "/productos/{$id}");

        if ($response->successful()) {
            $mueble = $response->json();
            return view('cliente.producto-detalle', compact('mueble'));
        }

        return redirect()->route('catalogo')->with('error', 'El mueble solicitado no está disponible en la red.');
    }
}
