<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PayPalController extends Controller
{
    private $apiUrl = "http://127.0.0.1:8000/api/paypal";

    public function payment(Request $request)
    {
        $token = session('token');
        
        // Obtenemos o generamos datos
        $monto = $request->monto ?? session('monto_pedido', 0.00);
        $id_pedido = $request->id_pedido ?? session('last_order_id', rand(1000, 9999));

        // GUARDAR EN SESIÓN PARA EL REGRESO
        session(['last_order_id' => $id_pedido]);

        if (!$token) {
            return redirect()->route('login')->with('error', 'Sesión expirada.');
        }

        try {
            $response = Http::withToken($token)->timeout(20)->post($this->apiUrl . "/create", [
                'monto' => $monto,
                'id_pedido' => $id_pedido,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['paypal_link'])) {
                    return redirect()->away($data['paypal_link']);
                }
            }

            // SI FALLA, REGISTRAR EL ERROR Y REDIRIGIR A CANCEL
            Log::error('PAYPAL CLIENT ERROR:', $response->json());
            return redirect()->route('paypal.cancel')->with('error', 'PayPal rechazó la orden.');

        } catch (\Exception $e) {
            Log::error('PAYPAL CLIENT EXCEPTION:', ['msg' => $e->getMessage()]);
            return redirect()->route('paypal.cancel')->with('error', $e->getMessage());
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
            $response = Http::withToken(session('token'))
                ->post($this->apiUrl . "/capture", [
                    'token' => $paypalToken,
                    'id_pedido' => $id_pedido
                ]);

            if ($response->successful() && $response->json()['status'] == 'success') {
                session()->forget(['last_order_id', 'cart']);
                return view('cliente.pago_exitoso');
            }

            Log::error('PAYPAL SUCCESS CAPTURE FAIL:', $response->json());
            return redirect()->route('paypal.cancel')->with('error', 'No se pudo capturar el pago.');

        } catch (\Exception $e) {
            Log::error('PAYPAL SUCCESS EXCEPTION:', ['msg' => $e->getMessage()]);
            return redirect()->route('paypal.cancel')->with('error', $e->getMessage());
        }
    }

    public function cancel()
    {
        return view('cliente.pago_cancelado');
    }
}
