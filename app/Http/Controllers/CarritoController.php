<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Muestra el carrito de compras (Capa de Sesión).
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cliente.carrito', compact('cart'));
    }

    /**
     * Añade un mueble al carrito local.
     */
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;

        if(isset($cart[$id])) {
            $cart[$id]['cantidad']++;
        } else {
            $cart[$id] = [
                "nombre" => $request->nombre,
                "cantidad" => 1,
                "precio" => $request->precio,
                "imagen" => $request->imagen
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Mueble reservado en tu selección.');
    }

    /**
     * Limpia la selección de muebles.
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back();
    }
}
