<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PayPalController;

// --- RUTAS PÚBLICAS ---
Route::get('/', [CatalogoController::class, 'home'])->name('home');
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.show');
Route::view('/aviso-privacidad', 'aviso-privacidad')->name('aviso.privacidad');

// --- CARRITO ---
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
Route::post('/carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
Route::post('/carrito/increment', [CarritoController::class, 'increment'])->name('carrito.increment');
Route::post('/carrito/decrement', [CarritoController::class, 'decrement'])->name('carrito.decrement');
Route::post('/carrito/remove', [CarritoController::class, 'remove'])->name('carrito.remove');
Route::post('/carrito/update-metodo-entrega', [CarritoController::class, 'updateMetodoEntrega'])->name('carrito.update-metodo-entrega');

// --- AUTENTICACIÓN ---
Route::get('/login', [AuthController::class, 'Formulario'])->name('login');
Route::post('/login', [AuthController::class, 'Login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');
Route::get('/registro', [AuthController::class, 'Registro'])->name('registro');
Route::post('/registro', [AuthController::class, 'Register'])->name('register.post');

// --- FLUJO DE COMPRA ---
Route::get('/carrito/realizarCompra', [CarritoController::class, 'realizarCompra'])->name('carrito.realizarCompra');
Route::post('/carrito/procesar', [CarritoController::class, 'procesarPedido'])->name('carrito.procesar');

// --- PAYPAL (Nombres únicos para evitar conflictos) ---
Route::get('/payment/paypal', [PayPalController::class, 'payment'])->name('paypal.payment');
Route::get('/payment/paypal/success', [PayPalController::class, 'success'])->name('paypal.success');
Route::get('/payment/paypal/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');

// --- PERFIL ---
Route::get('/perfil', [ClienteController::class, 'profile'])->name('cliente.perfil');
Route::get('/pedidos', [ClienteController::class, 'pedidos'])->name('cliente.pedidos');
Route::post('/pedidos/{id}/cancelar', [ClienteController::class, 'cancelarPedido'])->name('cliente.pedidos.cancelar');
Route::get('/perfil/editar', [ClienteController::class, 'editarPerfil'])->name('cliente.perfil.editar');
Route::put('/perfil/update', [ClienteController::class, 'updatePerfil'])->name('cliente.perfil.update');
Route::get('/direccion', [ClienteController::class, 'direccion'])->name('cliente.direccion');
Route::post('/direccion', [ClienteController::class, 'updateDireccion'])->name('cliente.direccion.update');
Route::delete('/direccion/{id}', [ClienteController::class, 'eliminarDireccion'])->name('cliente.direccion.eliminar');

// PDF
Route::get('/aviso-privacidaad/descargar', [ClienteController::class, 'descargarAvisoPrivacidad'])->name('aviso.descargar');
