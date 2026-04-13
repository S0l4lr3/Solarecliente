<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PayPalController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        // Leemos la URL base del backend desde el .}env o algo asi
        $this->apiUrl = env('API_URL', 'http://localhost:8000/api');
    }

    public function payment(Request $request)
    {
        $token = session('token');
        
        // Obtenemos los datos del pedido
        $monto = $request->monto ?? session('monto_pedido', 0.00);
        $id_pedido = $request->id_pedido ?? session('last_order_id', rand(1000, 9999));

        // Guardamos el ID del pedido en la sesión para recuperarlo al volver de PayPal
        session(['last_order_id' => $id_pedido]);

        if (!$token) {
            return redirect()->route('login')->with('error', 'Sesión expirada o no iniciada.');
        }

        try {
            // Llamamos a la API del backend para crear la orden de PayPal
            $response = Http::withToken($token)->timeout(20)->post($this->apiUrl . "/paypal/create", [
                'monto' => $monto,
                'id_pedido' => $id_pedido,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['paypal_link'])) {
                    return redirect()->away($data['paypal_link']);
                }
            }

            // Si hay un error, registramos el log para auditoría
            Log::error('PAYPAL_CREATE_ERROR:', $response->json() ?? ['error' => 'Respuesta vacía']);
            return redirect()->route('paypal.cancel')->with('error', 'PayPal rechazó la orden. Revisa el log del backend.');

        } catch (\Exception $e) {
            Log::error('PAYPAL_EXCEPTION_CREATE:', ['msg' => $e->getMessage()]);
            return redirect()->route('paypal.cancel')->with('error', 'Error de conexión con el servidor de pagos.');
        }
    }

    public function success(Request $request)
    {
        $paypalToken = $request->query('token');
        $id_pedido = session('last_order_id');

        if (!$paypalToken) {
            return redirect()->route('paypal.cancel')->with('error', 'Token de PayPal no encontrado.');
        }

        try {
            // Llamamos a la API del backend para capturar el pago y reducir el inventario (Evita robo hormiga)
            $response = Http::withToken(session('token'))
                ->post($this->apiUrl . "/paypal/capture", [
                    'token' => $paypalToken,
                    'id_pedido' => $id_pedido
                ]);

            if ($response->successful() && $response->json()['status'] == 'success') {
                $pedido = $response->json()['data'] ?? null;
                
                // Limpiamos el carrito y el ID del pedido solo si el pago fue exitoso
                session()->forget(['last_order_id', 'cart']);
                
                return view('cliente.pago_exitoso', compact('pedido'));
            }

            Log::error('PAYPAL_CAPTURE_FAIL:', $response->json());
            return redirect()->route('paypal.cancel')->with('error', 'No se pudo capturar el pago o confirmar el pedido.');

        } catch (\Exception $e) {
            Log::error('PAYPAL_EXCEPTION_CAPTURE:', ['msg' => $e->getMessage()]);
            return redirect()->route('paypal.cancel')->with('error', 'Error al procesar la confirmación del pago.');
        }
    }

    public function cancel()
    {
        return view('cliente.pago_cancelado');
    }
}