<?php

namespace Tests\Feature;

use Mockery;
use Tests\TestCase;
use App\Models\Event;
use App\Models\Speaker;
use App\Repositories\EventRepository;
use App\Repositories\SpeakerRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageControllerTest extends TestCase
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
        ]);
    }

    /** @test */
    public function it_shows_the_index_page_with_expected_data()
    {
        $speaker1 = Speaker::factory()->create();
        $speaker2 = Speaker::factory()->create();

        // Crear algunos registros de prueba
        Event::factory()->create(['category_id' => 1, 'speaker_id' => $speaker1->id]);
        Event::factory()->create(['category_id' => 2, 'speaker_id' => $speaker2->id]);

        // Crear una solicitud GET simulada
        $response = $this->get('/');

        // Acción
        $response->assertStatus(200);

        // Verificación
        $response->assertViewHas('eventos');
        $response->assertViewHas('ponentes');
        $response->assertViewHas('workshops');
        $response->assertViewHas('conferencias');
        $response->assertViewHas('speakers');

        $eventos = $response->original->getData()['eventos'];
        $this->assertCount(2, $eventos);

        $ponentes = $response->original->getData()['ponentes'];
        $this->assertEquals(2, $ponentes);

        $workshops = $response->original->getData()['workshops'];
        $this->assertEquals(1, $workshops);

        $conferencias = $response->original->getData()['conferencias'];
        $this->assertEquals(1, $conferencias);

        $speakers = $response->original->getData()['speakers'];
        $this->assertCount(2, $speakers);
    }

    /** @test */
    public function it_return_view_virtulmeet()
    {
        $response = $this->get('/virtualmeet');

        $response->assertViewIs('paginas.virtualmeet');
    }
    
    /** @test */
    public function  it_return_view_conferencias()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        $this->seed([
            'Database\\Seeders\\SpeakerSeeder',

        ]);

        Event::factory()->create(['day_id' => 1, 'category_id' => 1]);
        Event::factory()->create(['day_id' => 2, 'category_id' => 1]);
        Event::factory()->create(['day_id' => 1, 'category_id' => 2]);
        Event::factory()->create(['day_id' => 2, 'category_id' => 2]);

        $response = $this->get('/conferencias-workshops');

        $response->assertViewIs('paginas.conferencias-workshops');

        $response->assertViewHas('eventos');

        // Comprueba que los eventos se han formateado correctamente
        $formattedEvents = $response->original->getData()['eventos'];
        $this->assertArrayHasKey('conferencias_v', $formattedEvents);
        $this->assertArrayHasKey('conferencias_s', $formattedEvents);
        $this->assertArrayHasKey('workshops_v', $formattedEvents);
        $this->assertArrayHasKey('workshops_s', $formattedEvents);

    }

    /** @test */
    public function it_return_view_all_speakers()
    {
        Speaker::factory(2)->create();

        $response = $this->get('/speaker');

        $response->assertViewIs('paginas.speakers');

        $response->assertViewHas('speakers');

        $speakers = Speaker::all();

        $response->assertViewHas('speakers', $speakers);
    }
}
