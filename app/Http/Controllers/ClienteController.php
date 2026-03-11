<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function home()
    {
        return view('cliente.home');
    }
    
    public function catalogo()
    {
        return view('cliente.catalogo');
    }
    
    public function carrito()
    {
        return view('cliente.carrito');
    }
}