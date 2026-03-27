<?php

namespace Tests\Feature;

use Tests\TestCase;

class ClienteNavigationTest extends TestCase
{
    /** @test */
    public function la_home_es_accesible_C301()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function el_catalogo_es_accesible_C302()
    {
        $response = $this->get('/catalogo');
        $response->assertStatus(200);
    }

    /** @test */
    public function el_carrito_es_accesible_C303()
    {
        $response = $this->get('/carrito');
        $response->assertStatus(200);
    }

    /** @test */
    public function el_formulario_de_registro_es_accesible_C304()
    {
        $response = $this->get('/registro');
        $response->assertStatus(200);
    }
}
