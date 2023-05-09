<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use App\Models\Record;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

      public function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'Database\\Seeders\\GiftSeeder',
            'Database\\Seeders\\PackageSeeder',
            'Database\\Seeders\\TimeSeeder',
            'Database\\Seeders\\DaySeeder',
            'Database\\Seeders\\CategorySeeder',
            'Database\\Seeders\\UserSeeder',
            'Database\\Seeders\\SpeakerSeeder',
        ]);
    }
    
    /** @test */
    public function it_can_display_the_dashboard_page()
    {
        // Crear algunos registros y eventos de prueba
        Record::factory()->create(['package_id' => 1]);
        Record::factory()->create(['package_id' => 2]);
        Event::factory()->create(['available' => 10]);
        Event::factory()->create(['available' => 100]);
        Event::factory(10)->create();

        // Hacer una solicitud GET a la página de inicio del panel
        $response = $this->get('/dashboard');

        // Verificar que la página se cargue correctamente
        $response->assertOk();
        $response->assertViewIs('admin.dashboard.index');

        
        // Verificar que se pasan los datos correctos a la vista
        $response->assertViewHas('registros');
        $response->assertViewHas('ingresos');

        $response->assertViewHas('mas_disponibles');
        $result = $response->viewData('menos_disponibles');
        $this->assertEquals(10, $result->first()->available);
        $this->assertCount(5, $result);

        $response->assertViewHas('mas_disponibles');
        $result = $response->viewData('mas_disponibles');
        $this->assertEquals(100, $result->first()->available);
        $this->assertCount(5, $result);
    }
}
