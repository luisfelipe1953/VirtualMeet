<?php

namespace Tests\Feature;

use App\Models\Day;
use Tests\TestCase;
use App\Models\Time;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\Category;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class EventControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    
    /** @test */
    public function it_displays_the_create_event()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        // When - Cuando se visita la página de creación de eventos
        $response = $this->get(route('events.create'));

        // Then - Entonces se debe cargar la vista de creación de eventos con los datos correctos
        $response->assertSuccessful();
        $response->assertViewIs('admin.events.create');
        $response->assertViewHas('data');
        $response->assertViewHas('evento');

        $data = $response->viewData('data');
        $this->assertArrayHasKey('days', $data);
        $this->assertArrayHasKey('times', $data);
        $this->assertArrayHasKey('categories', $data);
    }

    /** @test */
    public function it_stores_a_new_event()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();


        // Given - Dado que tenemos los datos de un nuevo evento
        $data = [
            'name' => 'Nuevo Evento',
            'description' => 'Descripción del nuevo evento',
            'available' => 10,
            'category_id' => Category::inRandomOrder()->first()->id,
            'day_id' => Day::inRandomOrder()->first()->id,
            'time_id' => Time::inRandomOrder()->first()->id,
            'speaker_id' => Speaker::inRandomOrder()->first()->id,
        ];

        // When - Cuando se envía una petición POST para guardar el nuevo evento
        $response = $this->post(route('eventos.store'), $data);

        // Then - Entonces el evento debe ser creado y redireccionar a la página de índice de eventos con mensaje de éxito
        $response->assertRedirect(route('events.index'));
        $response->assertSessionHas('success', 'Agregado Correctamente');
        $this->assertDatabaseHas('events', $data);
    }

    /** @test */
    public function it_displays_the_edit_event()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        // Given - Dado que existe un evento en la base de datos
        $event = Event::factory()->create();

        // When - Cuando se visita la página de edición del evento
        $response = $this->get(route('events.edit', $event));

        // Then - Entonces se debe cargar la vista de edición de eventos con los datos correctos
        $response->assertSuccessful();
        $response->assertViewIs('admin.events.edit');
        $response->assertViewHas('data');
        $response->assertViewHas('evento');

        $data = $response->viewData('data');
        $this->assertArrayHasKey('days', $data);
        $this->assertArrayHasKey('times', $data);
        $this->assertArrayHasKey('categories', $data);

        $events = $response->viewData('evento');
        $this->assertEquals($event->id, $events->id);
    }

    /** @test */
    public function it_updates_an_existing_event()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        // Given - Dado que existe un evento en la base de datos
        $event = Event::factory()->create();

        // When - Cuando se envía una solicitud para actualizar el evento
        $response = $this->put(route('eventos.update', $event->id), [
            'name' => 'Nuevo nombre del evento',
            'description' => 'Nueva descripción del evento',
            'available' => 100,
            'category_id' => 1,
            'time_id' => 1,
            'day_id' => 1,
            'speaker_id' => 4,
        ]);

        // Then - Entonces se debe redirigir a la lista de eventos con un mensaje de éxito
        $response->assertRedirect(route('events.index'));
        $response->assertSessionHas('success', 'Editado Correctamente');

        // Comprobar que el evento ha sido actualizado correctamente en la base de datos
        $updatedEvent = Event::find($event->id);

        $this->assertEquals('Nuevo nombre del evento', $updatedEvent->name);
        $this->assertEquals('Nueva descripción del evento', $updatedEvent->description);
        $this->assertEquals(100, $updatedEvent->available);
        $this->assertEquals(1, $updatedEvent->category_id);
        $this->assertEquals(1, $updatedEvent->time_id);
        $this->assertEquals(1, $updatedEvent->day_id);
        $this->assertEquals(4, $updatedEvent->speaker_id);
    }

    /** @test */
    public function it_deletes_an_event()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        // Given - Dado que existe un evento en la base de datos
        $event = Event::factory()->create();

        // When - Cuando se envía una solicitud para eliminar el evento
        $response = $this->delete(route('eventos.destroy', $event->id));

        // Then - Entonces se debe redirigir a la lista de eventos con el mensaje correcto
        $response->assertRedirect(route('events.index'));
        $response->assertSessionHas('success', 'Eliminado Correctamente');

        // Asegurarse de que el evento se haya eliminado de la base de datos
        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }


    /** @test */
    public function it_displays_the_event_index()
    {
        $this->withoutEvents();

        // When - Cuando se visita la página de índice de eventos
        $response = $this->get(route('events.index'));

        Event::paginate(5);

        // Then - Entonces se debe cargar la vista de índice de eventos con los eventos correctos
        $response->assertSuccessful();
        $response->assertViewIs('admin.events.index');
        $response->assertViewHas('eventos');
        $this->assertInstanceOf(Paginator::class, $response->viewData('eventos'));
    }
}
