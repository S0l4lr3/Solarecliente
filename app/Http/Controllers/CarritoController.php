<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CarritoController extends Controller
{
    const IVA_RATE = 0.16;
    const ENVIO_COST = 200;
    const PICKUP_COST = 0;

    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = rtrim(env('API_URL', 'http://127.0.0.1:8000/api'), '/');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $metodo_entrega = session()->get('metodo_entrega', 'pickup');
        $calculos = $this->calcularTotales($cart, $metodo_entrega);
        return view('cliente.carrito', compact('cart', 'calculos', 'metodo_entrega'));
    }

    /**
     * Añade un producto al carrito o incrementa su cantidad si hay stock.
     */
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;

        // Validamos stock con el backend
        $stockDisponible = $this->obtenerStock($id);
        $cantidadActual = isset($cart[$id]) ? $cart[$id]['cantidad'] : 0;

        if ($cantidadActual + 1 > $stockDisponible) {
            return redirect()->back()->with('error', 'Lo sentimos, solo quedan ' . $stockDisponible . ' unidades disponibles.');
        }

        if(isset($cart[$id])) {
            $cart[$id]['cantidad']++;
        } else {
            $cart[$id] = [
                "nombre" => $request->nombre,
                "cantidad" => 1,
                "precio" => $request->precio,
                "imagen" => $request->imagen,
                "stock_max" => $stockDisponible
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('carrito')->with('success', 'Producto añadido al carrito.');
    }

    /**
     * Incrementa la cantidad de un item validando el stock.
     */
    public function increment(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $stockDisponible = $this->obtenerStock($id);
            if ($cart[$id]['cantidad'] + 1 > $stockDisponible) {
                return redirect()->back()->with('error', 'No hay más stock disponible.');
            }
            $cart[$id]['cantidad']++;
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    /**
     * Decrementa la cantidad o elimina el item si llega a cero.
     */
    public function decrement(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['cantidad']--;
            if ($cart[$id]['cantidad'] <= 0) {
                unset($cart[$id]);
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Producto eliminado del carrito.');
            }
            session()->put('cart', $cart);
        }

        return redirect()->back();
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

    /**
     * Consulta el stock real del producto en el backend.
     */
    private function obtenerStock($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/productos/{$id}");
            if ($response->successful()) {
                $data = $response->json();
                // El stock puede estar en el producto o en sus variantes. 
                // Priorizamos el stock general del producto para esta lógica simple.
                return $data['stock'] ?? 0;
            }
        } catch (\Exception $e) {
            Log::error("Error al consultar stock para producto {$id}: " . $e->getMessage());
        }
        return 0;
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
        $subtotal = 0;
        foreach($cart as $item) { 
            $subtotal += $item['precio'] * $item['cantidad']; 
        }
        
        // El IVA se calcula sobre el subtotal acumulado de todos los productos
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
            'costo_entrega_formato' => '$' . number_format($costo_entrega, 2),
            'total_formato' => '$' . number_format($total, 2) . ' MXN'
        ];
    }

    public function realizarCompra(Request $request)
    {
        if (!session()->has('token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para comprar.');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('carrito')->with('error', 'Tu carrito está vacío.');
        }

        $metodo_entrega = $request->metodo_entrega ?? session()->get('metodo_entrega', 'pickup');
        session()->put('metodo_entrega', $metodo_entrega);

        $calculos = $this->calcularTotales($cart, $metodo_entrega);
        return view('cliente.formulario_pago', compact('cart', 'calculos', 'metodo_entrega'));
    }

    public function procesarPedido(Request $request)
    {
        if (!session()->has('token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('catalogo');

        $metodo_pago = $request->metodo_pago;
        $metodo_entrega = session()->get('metodo_entrega', 'pickup');
        $calculos = $this->calcularTotales($cart, $metodo_entrega);

        try {
            $items = [];
            foreach ($cart as $id => $details) {
                $items[] = [
                    'id' => $id,
                    'cantidad' => $details['cantidad'],
                    'precio' => $details['precio']
                ];
            }

            $response = Http::withToken(session('token'))
                ->acceptJson() // IMPORTANTE: Pedimos JSON explícitamente
                ->post("{$this->apiUrl}/pedidos", [
                    'items' => $items,
                    'metodo_entrega' => $metodo_entrega,
                    'total' => $calculos['total']
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $pedido_id = $data['pedido_id'] ?? null;

                if ($pedido_id) {
                    session(['last_order_id' => $pedido_id, 'monto_pedido' => $calculos['total']]);

                    if ($metodo_pago === 'paypal') {
                        return redirect()->route('paypal.payment', [
                            'monto' => $calculos['total'],
                            'id_pedido' => $pedido_id
                        ]);
                    }

                    session()->forget(['cart', 'metodo_entrega']);
                    return redirect()->route('catalogo')->with('success', '¡Pedido realizado con éxito!');
                }
                
                // Si llegamos aquí con un 200 pero sin pedido_id
                $cuerpo = substr($response->body(), 0, 150);
                return back()->with('error', "Error 200 (Estructura Inválida). El servidor respondió: {$cuerpo}...");
            }

            // DEBUG DE ERROR PARA OTROS CÓDIGOS (401, 500, etc)
            $status = $response->status();
            $msgFinal = "Error {$status}: " . ($response->json()['mensaje'] ?? 'El servidor rechazó el pedido.');
            return back()->with('error', $msgFinal);

            } catch (\Exception $e) {
            return back()->with('error', 'Fallo de conexión crítica: ' . $e->getMessage());
            }

    }
}
