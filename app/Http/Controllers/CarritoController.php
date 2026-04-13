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
        $this->apiUrl = env('API_URL', 'http://localhost:8000/api');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $metodo_entrega = session()->get('metodo_entrega', 'pickup');
        $calculos = $this->calcularTotales($cart, $metodo_entrega);
        return view('cliente.carrito', compact('cart', 'calculos', 'metodo_entrega'));
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
            // 1. Formateamos los items con seguridad
            $items = [];
            foreach ($cart as $id => $details) {
                if (isset($details['cantidad']) && isset($details['precio'])) {
                    $items[] = [
                        'id' => $id,
                        'cantidad' => $details['cantidad'],
                        'precio' => $details['precio']
                    ];
                }
            }

            // 2. Registro Real en el Backend
            $response = Http::withToken(session('token'))
                ->timeout(15)
                ->post("{$this->apiUrl}/pedidos", [
                    'items' => $items
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $pedido_id = $data['pedido_id'] ?? null;

                if ($pedido_id) {
                    session(['last_order_id' => $pedido_id]);

                    if ($metodo_pago === 'paypal') {
                        return redirect()->route('paypal.payment', [
                            'monto' => $calculos['total'],
                            'id_pedido' => $pedido_id
                        ]);
                    }

                    session()->forget(['cart', 'metodo_entrega', 'datos_envio']);
                    return redirect()->route('catalogo')->with('success', '¡Pedido realizado con éxito!');
                }
            }

            // Si llegamos aquí, el backend falló pero no tronó
            $msgError = $response->json()['mensaje'] ?? 'El servidor no pudo registrar el pedido por un error técnico.';
            return back()->with('error', $msgError);

        } catch (\Exception $e) {
            Log::error('EXCEPTION_PROCESAR_PEDIDO:', ['msg' => $e->getMessage()]);
            return back()->with('error', 'Error de conexión con el servidor de pedidos. Por favor, intenta de nuevo.');
        }
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
        $subtotal = 0;
        foreach($cart as $item) { $subtotal += $item['precio'] * $item['cantidad']; }
        
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
}