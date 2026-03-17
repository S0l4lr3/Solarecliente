<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;


// Ruta principal
Route::get('/', [CatalogoController::class, 'home'  ])->name('home');


// Catálogo
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');

// Detalle de Producto
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.show');

// Carrito de Compras
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
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

// Aviso de Privacidad
Route::view('/aviso-privacidad', 'aviso-privacidad')->name('aviso.privacidad');