<?php

namespace Tests\Feature;

use Mockery;
use Tests\TestCase;
use App\Models\Gift;
use App\Models\User;
use App\Models\Event;
use App\Models\Record;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RecordControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'Database\\Seeders\\GiftSeeder',
            'Database\\Seeders\\PackageSeeder',
            'Database\\Seeders\\TimeSeeder',
            'Database\\Seeders\\DaySeeder',
            'Database\\Seeders\\SpeakerSeeder',
            'Database\\Seeders\\CategorySeeder',
        ]);
    }

    /** @test */
    public function debe_redirigir_a_conferencias_si_el_usuario_ya_tiene_un_registro_con_paquete_one()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        // Creamos un usuario para simular la sesión iniciada
        $user = User::factory()->create();

        // Creamos un registro para el usuario
        Record::factory()->create(
            [
                'user_id' => $user->id,
                'package_id' => Record::ONE,
            ]
        );

        // Enviamos una petición GET a la ruta /packages
        $response = $this->actingAs($user)->get('/packages');

        // Verificamos que la respuesta tenga un estado HTTP 302 (Found, es decir, redirección)
        $response->assertStatus(302);

        // Verificamos que se haya redirigido a la ruta /finalizar-registro/conferencias
        $response->assertRedirect('/finalizar-registro/conferencias');
    }

    public function test_package_returns_view_for_authenticated_users()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        // Creamos un usuario para simular la sesión iniciada
        $user = User::factory()->create();

        // Enviamos una petición GET a la ruta /packages
        $response = $this->actingAs($user)->get('/packages');

        // Verificamos que la respuesta tenga un estado HTTP 200 (OK)
        $response->assertOk();

        // Verificamos que la vista retornada sea la correcta
        $response->assertViewIs('paginas.paquetes');
    }

    /** @test */
    public function debe_redirigir_a_login_si_el_usuario_no_esta_autenticado()
    {
        $this->withoutEvents();

        $response = $this->get('/packages');

        $response->assertStatus(302);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function debe_redirigir_a_boleto_si_el_usuario_ya_tiene_un_registro_y_el_paquete_es_tree_o_two()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        $user = User::factory()->create();

        $this->actingAs($user);

        $record =  Record::factory()->create([
            'user_id' => $user->id,
            'package_id' => Record::TREE,
        ]);

        $response = $this->get('/packages');

        $response->assertStatus(302);

        $response->assertRedirect('/ticket?id=' . urlencode($record->token));
    }



    public function test_package_redirects_to_login_for_unauthenticated_users()
    {
        $this->withoutEvents();

        // Enviamos una petición GET a la ruta /packages
        $response = $this->get('/packages');

        // Verificamos que la respuesta tenga un estado HTTP 302 (Found, es decir, redirección)
        $response->assertStatus(302);

        // Verificamos que se haya redirigido a la ruta /login
        $response->assertRedirect('/login');

        // Verificamos que se haya incluido el mensaje "Por favor inicia sesión para continuar."
        $response->assertSessionHas('success', 'Por favor inicia sesión para continuar.');
    }

    public function test_package_gratis_redirects()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/finalizar-registro/gratis');

        $response->assertRedirect($response->headers->get('location'));
    }

    public function test_pagar()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        $user = User::factory()->create();

        $recordData = [
            'package_id' => '3',
            'payment_id' => 'AS4DA4SD11DA14SA',
        ];

        $response = $this->actingAs($user)->post('/packagesfinish-registration/pay', $recordData);

        $response->assertStatus(200);

        $recordInfo = $response->json();

        $this->assertNotNull($recordInfo);
        $this->assertEquals($user->id, $recordInfo['user_id']);
        $this->assertEquals($recordData['package_id'], $recordInfo['package_id']);
        $this->assertEquals($recordData['payment_id'], $recordInfo['payment_id']);
    }

    public function test_boleto()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        // Crea un registro en la BD        
        $user = User::factory()->create();

        $registro = Record::factory()->create(['user_id' => $user->id]);

        // Envía una solicitud GET al endpoint de la vista del boleto con el ID del registro
        $response = $this->get('/ticket?id=' . $registro->token);

        // Comprueba que la respuesta tenga un código de estado 200
        $response->assertStatus(200);

        // Comprueba que la respuesta contenga la vista 'registro.boletos'
        $response->assertViewIs('registro.boletos');

        // Comprueba que la vista contenga el registro
        $response->assertViewHas('registro', $registro);
    }



    public function test_elegir_conferencia_si_el_usuario_no_tiene_conferencias_registrados()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        $user = User::factory()->create();

        $this->actingAs($user);

        Event::factory(10)->create();

        Record::factory()->create(['user_id' => $user->id]);

        // Simula una petición HTTP con el token del usuario
        $response = $this->get('finalizar-registro/conferencias');

        // Comprueba que la respuesta es exitosa
        $response->assertStatus(200);

        // Comprueba que se está cargando la vista "registro.conferencias"
        $response->assertViewIs('registro.conferencias');

        // Comprueba que los eventos y regalos se están pasando a la vista
        $response->assertViewHas(['eventos', 'regalos']);

        // Comprueba que los eventos se han formateado correctamente
        $formattedEvents = $response->original->getData()['eventos'];
        $this->assertArrayHasKey('conferencias_v', $formattedEvents);
        $this->assertArrayHasKey('conferencias_s', $formattedEvents);
        $this->assertArrayHasKey('workshops_v', $formattedEvents);
        $this->assertArrayHasKey('workshops_s', $formattedEvents);
    }

    public function test_elegir_conferencia_redirecciona_a_boleto_si_ya_tiene_registros()
    {

        $user = User::factory()->create();

        $this->actingAs($user);

        $record = Record::factory()->create(['user_id' => $user->id]);

        $event = Event::factory()->create();

        $record->event()->attach($event);

        // Hacer una petición a la ruta elegirConferencia
        $response = $this->get('finalizar-registro/conferencias');

        // Verificar que se redirige a la ruta boleto con el token del registro en la URL
        $response->assertRedirect('/ticket?id=' . urlencode($record->token));
    }

    public function test_record_conferences_or_workshops()
    {

        // Crear el usuario de registro
        $user = User::factory()->create();

        $this->actingAs($user);

        // Crear los eventos disponibles
        $events = Event::factory(5)->create(['available' => 1]);

        // Crear un regalo
        $gift = Gift::find(1)->first();

        // Creamos un registro para el usuario
        $record = Record::factory()->create(
            [
                'user_id' => $user->id,
                'package_id' => Record::ONE,
                'gift_id' => $gift->id
            ]
        );

        // Crear los datos de la solicitud
        $eventosSeleccionados = $events->pluck('id')->implode(',');
        $datosSolicitud = [
            'eventos' => $eventosSeleccionados,
            'regalo_id' => $gift->id,
        ];

        // Realizar la solicitud HTTP
        $response = $this->post('finalizar-registro/conferencias', $datosSolicitud);

        $registroEventos = $record->event->toArray();

        $this->assertCount($events->count(), $registroEventos);

        foreach ($registroEventos as $event) {
            $this->assertEquals(0, $event['available']);
        }

        $this->assertEquals($gift->id, $record->gift_id);

        // Verificar la respuesta
        $response->assertSuccessful();

        $response->assertJson([
            'resultado' => true,
            'token' => $record->token,
        ]);
    }
}
