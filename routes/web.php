<?php

use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('cliente.home');
})->name('home');

// Catálogo
Route::get('/catalogo', function () {
    return view('cliente.catalogo');
})->name('catalogo');

// Carrito
Route::get('/carrito', function () {
    return view('cliente.carrito');
})->name('carrito');

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Registro
Route::get('/registro', function () {
    return view('auth.registro');
})->name('registro');