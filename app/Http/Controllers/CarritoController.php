<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\DetallePedido;

class CarritoController extends Controller
{
    const IVA_RATE = 0.16; // IVA
    const ENVIO_COST = 200; // Costo de envío fijo
    const PICKUP_COST = 0; // Recoger en tienda no tiene costo 

    /**
     * Muestra el carrito de compras.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $metodo_entrega = session()->get('metodo_entrega', 'pickup');
        
        $calculos = $this->calcularTotales($cart, $metodo_entrega);
        
        return view('cliente.carrito', compact('cart', 'calculos', 'metodo_entrega'));
    }


 public function realizarCompra(Request $request)
{
    // Verificar si el usuario está autenticado (registrado)
    if (!auth()->check()) {
        // Usuario no está registrado - redirigir al login con mensaje
        return redirect()->route('login')
            ->with('error', 'Debes iniciar sesión o registrarte para realizar una compra.');
    }
    
    //Si tiene cuenta continua normal 
    $cart = session()->get('cart', []);

    // Obtener el método de entrega del formulario o de la sesión
    $metodo_entrega = $request->metodo_entrega ?? session()->get('metodo_entrega', 'pickup');
    
    // Guardar el método de entrega en sesión
    session()->put('metodo_entrega', $metodo_entrega);
    
    $calculos = $this->calcularTotales($cart, $metodo_entrega);
    
    return view('cliente.formulario_pago', compact('cart', 'calculos', 'metodo_entrega'));
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
        
        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    /**
     * Elimina un producto del carrito.
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
        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    /**
     * Actualiza el método de entrega para envío o pickup
     */
    public function updateMetodoEntrega(Request $request)
    {
        $metodo_entrega = $request->metodo_entrega;
        
        if (!in_array($metodo_entrega, ['envio', 'pickup'])) {
            return response()->json(['error' => 'Método no válido'], 400);
        }
        
        session()->put('metodo_entrega', $metodo_entrega);
        
        return response()->json([
            'success' => true,
            'calculos' => $this->calcularTotales(session()->get('cart', []), $metodo_entrega)
        ]);
    }

    /**
     * Procesa el pedido
     */
    public function procesarPedido(Request $request)
    {
            // Verificar si el usuario está autenticado (registrado)
    if (response()->json(['error' => 'Debes iniciar sesión o registrarte para realizar una compra.'])) {
        // Usuario no está registrado - redirigir al login con mensaje
        return redirect()->route('login')
            ->with('error', 'Debes iniciar sesión o registrarte para realizar una compra.');
    }else{
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->back()->with('error', 'El carrito está vacío');
        }

        $metodo_entrega = session()->get('metodo_entrega', 'pickup');
        $calculos = $this->calcularTotales($cart, $metodo_entrega);


        // Limpiar el carrito después de finalizar 
        session()->forget('cart');
        session()->forget('metodo_entrega');

        return redirect()->route('catalogo')->with('success', '¡Pedido realizado con éxito! Pronto te contactaremos para confirmar.');
    }
}

    /**
     * Calcula todos los totales basado en el método de entrega
     */
    public function calcularTotales($cart, $metodo_entrega = 'pickup')
    {
        $subtotal = $this->calcularSubtotal($cart);
        $iva = $subtotal * self::IVA_RATE;
        
        $costo_entrega = 0;
        $metodo_texto = '';
        
        if ($metodo_entrega === 'envio') {
            $costo_entrega = self::ENVIO_COST;
            $metodo_texto = 'Envío a domicilio';
        } else {
            $costo_entrega = self::PICKUP_COST;
            $metodo_texto = 'Recoger en tienda (Pick Up)';
        }
        
        $total = $subtotal + $iva + $costo_entrega;

        return [
            'subtotal' => $subtotal,
            'iva' => $iva,
            'costo_entrega' => $costo_entrega,
            'total' => $total,
            'metodo_entrega' => $metodo_entrega,
            'metodo_texto' => $metodo_texto,
            
            'subtotal_formato' => '$' . number_format($subtotal, 2),
            'iva_formato' => '$' . number_format($iva, 2),
            'costo_entrega_formato' => $costo_entrega > 0 ? '$' . number_format($costo_entrega, 2) : 'Gratis',
            'total_formato' => '$' . number_format($total, 2) . ' MXN'
        ];
    }

    /**
     * Calcula el subtotal del carrito
     */
    private function calcularSubtotal($cart)
    {
        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }
        return $subtotal;
    }


}