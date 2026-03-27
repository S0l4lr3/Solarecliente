<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\DetallePedido;

class CarritoController extends Controller
{
    const IVA_RATE = 0.16;
    const ENVIO_COST = 200;
    const PICKUP_COST = 0;

    public function index()
    {
        $cart = session()->get('cart', []);
        $metodo_entrega = session()->get('metodo_entrega', 'pickup');
        $calculos = $this->calcularTotales($cart, $metodo_entrega);
        return view('cliente.carrito', compact('cart', 'calculos', 'metodo_entrega'));
    }

    public function realizarCompra(Request $request)
    {
        // Validación de sesión simple
        if (!session()->has('token')) {
            session(['url.intended' => url()->current()]);
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para comprar.');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('carrito')->with('error', 'Tu carrito está vacío.');
        }

        $metodo_entrega = $request->metodo_entrega ?? session()->get('metodo_entrega', 'pickup');
        session()->put('metodo_entrega', $metodo_entrega);

        if ($metodo_entrega === 'pickup') {
            $calculos = $this->calcularTotales($cart, $metodo_entrega);
            return view('cliente.formulario_pago', compact('cart', 'calculos', 'metodo_entrega'));
        }

        return view('cliente.formulario_envio');
    }

    // NUEVO: Recibe datos de envío y muestra pago
    public function mostrarFormularioPago(Request $request)
    {
        // Guardamos datos de envío en sesión para usarlos al final
        session(['datos_envio' => $request->all()]);

        $cart = session()->get('cart', []);
        $metodo_entrega = session()->get('metodo_entrega', 'envio');
        $calculos = $this->calcularTotales($cart, $metodo_entrega);

        return view('cliente.formulario_pago', compact('cart', 'calculos', 'metodo_entrega'));
    }

    // Procesa el guardado final en la BD
    public function procesarPedido(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('catalogo');

        // Aquí iría tu lógica de $pedido = Pedido::create([...]);

        // Limpiar sesión
        session()->forget(['cart', 'metodo_entrega', 'datos_envio']);

        return redirect()->route('catalogo')->with('success', '¡Pedido realizado con éxito!');
    }

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
        return redirect()->back()->with('success', 'Producto agregado.');
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back()->with('success', 'Producto eliminado.');
    }

    public function updateMetodoEntrega(Request $request)
    {
        $metodo_entrega = $request->metodo_entrega;
        session()->put('metodo_entrega', $metodo_entrega);
        return response()->json([
            'success' => true,
            'calculos' => $this->calcularTotales(session()->get('cart', []), $metodo_entrega)
        ]);
    }

    public function calcularTotales($cart, $metodo_entrega = 'pickup')
    {
        $subtotal = $this->calcularSubtotal($cart);
        $iva = $subtotal * self::IVA_RATE;
        $costo_entrega = ($metodo_entrega === 'envio') ? self::ENVIO_COST : self::PICKUP_COST;
        $total = $subtotal + $iva + $costo_entrega;

        return [
            'subtotal' => $subtotal,
            'iva' => $iva,
            'costo_entrega' => $costo_entrega,
            'total' => $total,
            'subtotal_formato' => '$' . number_format($subtotal, 2),
            'iva_formato' => '$' . number_format($iva, 2),
            'total_formato' => '$' . number_format($total, 2) . ' MXN'
        ];
    }

    private function calcularSubtotal($cart)
    {
        $subtotal = 0;
        foreach($cart as $item) { $subtotal += $item['precio'] * $item['cantidad']; }
        return $subtotal;
    }
} 