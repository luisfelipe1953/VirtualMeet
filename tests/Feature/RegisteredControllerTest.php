<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Record;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisteredControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'Database\\Seeders\\GiftSeeder',
            'Database\\Seeders\\PackageSeeder',
            'Database\\Seeders\\UserSeeder',
        ]);
    }

    /** @test */
    public function it_return_view_registered()
    {
        // Crear algunos registros de prueba
        Record::factory(8)->create();

        // Hacer una solicitud GET a la ruta 'registrados.index'
        $response = $this->get('/registered');

        // Verificar que la respuesta del servidor tenga el código HTTP 200 (OK)
        $response->assertStatus(200);

        // Verificar que la vista 'admin.registrados.index' se haya cargado correctamente
        $response->assertViewIs('admin.registrados.index');

        // Verificar que la vista contenga el número correcto de registros por página
        $response->assertViewHas('registros');
        $registros = $response->viewData('registros');
        $this->assertCount(5, $registros);

        // Verificar que la vista contenga la paginación correcta
        $response->assertViewHas('paginacion');
        $paginacion = $response->viewData('paginacion');
        $this->assertEquals(1, $paginacion->pagina_actual);
        $this->assertEquals(5, $paginacion->registros_por_pagina);
        $this->assertEquals(8, $paginacion->total_registros);
    }
}
