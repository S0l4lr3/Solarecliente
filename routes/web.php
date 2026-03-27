<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ClienteController;

// Ruta principal
Route::get('/', [CatalogoController::class, 'home'])->name('home');

// Catálogo
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');

// Detalle de Producto
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.show');

// Carrito de Compras
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
Route::post('/carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
Route::post('/carrito/remove', [CarritoController::class, 'remove'])->name('carrito.remove');
Route::post('/carrito/update-metodo-entrega', [CarritoController::class, 'updateMetodoEntrega'])->name('carrito.update-metodo-entrega');
Route::post('/carrito/procesar', [CarritoController::class, 'procesarPedido'])->name('carrito.procesar');
Route::get('/carrito/realizarCompra', [CarritoController::class, 'realizarCompra'])->name('carrito.realizarCompra');

// Login
Route::get('/login', [AuthController::class, 'Formulario'])->name('login');
Route::post('/login', [AuthController::class, 'Login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');

// Registro
Route::get('/registro', [AuthController::class, 'Registro'])->name('registro');
Route::post('/registro', [AuthController::class, 'Register'])->name('register.post');


// Rutas de Perfil y Dirección (Solo para clientes autenticados)
Route::get('/perfil', [ClienteController::class, 'perfil'])->name('cliente.perfil');
Route::get('/perfil/editar', [ClienteController::class, 'editarPerfil'])->name('cliente.perfil.editar');
Route::put('/perfil/update', [ClienteController::class, 'updatePerfil'])->name('cliente.perfil.update');

Route::get('/direccion', [ClienteController::class, 'direccion'])->name('cliente.direccion');
Route::get('/direccion/editar', [ClienteController::class, 'editarDireccion'])->name('cliente.direccion.editar');
Route::put('/direccion/update', [ClienteController::class, 'updateDireccion'])->name('cliente.direccion.update');

// Aviso de Privacidad
Route::view('/aviso-privacidad', 'aviso-privacidad')->name('aviso.privacidad');

//Flujo de carrito y compra 
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
Route::get('/carrito/realizar-compra', [CarritoController::class, 'realizarCompra'])->name('carrito.realizarCompra');
Route::post('/carrito/pago', [CarritoController::class, 'mostrarFormularioPago'])->name('cliente.pago');
Route::post('/carrito/finalizar', [CarritoController::class, 'procesarPedido'])->name('cliente.pedido.realizado');