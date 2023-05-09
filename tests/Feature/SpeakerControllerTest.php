<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Speaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SpeakerControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function shows_the_view_to_create_the_speaker()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        // Simular una solicitud HTTP GET a la ruta de creación de ponentes
        $response = $this->get(route('ponentes.create'));

        // Verificar que la respuesta HTTP tenga el código 200 (OK)
        $response->assertOk();

        // Verificar que se esté utilizando la vista correcta
        $response->assertViewIs('admin.ponente.create');

        // Verificar que se esté pasando un objeto Speaker a la vista
        $response->assertViewHas('ponente', function ($ponente) {
            return $ponente instanceof Speaker;
        });

        // Verificar que se esté pasando un objeto con las redes sociales vacías a la vista
        $response->assertViewHas('redes', (object) array_fill_keys(['github', 'tiktok', 'youtube', 'twitter', 'facebook', 'instagram'], ''));
    }

    /** @test */
    public function create_speaker()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        Storage::fake('public');

        $response = $this->post('/ponentes', [
            'name' => 'John Doe',
            'lastname' => 'apellido',
            'city' => 'monteria',
            'country' =>  'colombia',
            'image' => UploadedFile::fake()->image('post.jpg'),
            'tags' => 'laravel,php,js,css',
            'networks' => null,
        ]);

        $response->assertStatus(302);

        $speaker = Speaker::first()->image;

        Storage::disk('public')->assertExists('img/speakers/' . $speaker . '.png');

        $response->assertRedirect(route('ponentes.index'));

        $response->assertSessionHas('success', 'Agregado Correctamente');

        $this->assertDatabaseCount('speakers', 1);
    }

    /** @test */
    public function shows_the_view_to_edit_the_speaker()
    {
        $this->withoutExceptionHandling();

        $this->withoutEvents();

        // Crea un ponente en la base de datos para poder editarlo
        $speaker = Speaker::factory()->create();

        // Realiza una solicitud GET a la ruta de edición del ponente
        $response = $this->get(route('ponentes.edit', $speaker->id));

        // Verifica que la respuesta tenga el estado HTTP 200
        $response->assertStatus(200);

        // Verificar que se esté utilizando la vista correcta
        $response->assertViewIs('admin.ponente.edit');

        // Verifica que se estén pasando los datos del ponente a la vista
        $response->assertViewHasAll([
            'ponente' => $speaker,
            'redes' => json_decode($speaker->networks),
        ]);
    }

    /** @test */
    public function update_the_speaker()
    {
        // Desactivar manejo de excepciones
        $this->withoutExceptionHandling();

        // Desactivar eventos
        $this->withoutEvents();

        // Crear un ponente para que se guarde la imagen en storage
        $speaker = [
            'name' => 'John Doe',
            'lastname' => 'apellido',
            'city' => 'monteria',
            'country' =>  'colombia',
            'image' => UploadedFile::fake()->image('post.jpg'),
            'tags' => 'laravel,php,js,css',
            'networks' => null,
        ];
        $response = $this->post('/ponentes', $speaker);

        // Obtener el primer ponente
        $firstSpeaker = Speaker::first();

        // Definir la variable de redes como nula
        $network = null;

        // Definir los datos de actualización
        $updateData = [
            'name' => 'John Doe (Actualizado)',
            'lastname' => 'apellido (Actualizado)',
            'city' => $firstSpeaker->city,
            'country' => $firstSpeaker->country,
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'tags' => $firstSpeaker->tags,
            'networks' => $network,
        ];

        // Hacer una petición PUT para actualizar el ponente
        $response = $this->put(route('ponentes.update', $firstSpeaker->id), $updateData);

        // Verificar que la imagen del ponente exista en el almacenamiento
        Storage::disk('public')->assertExists('img/speakers/' . $firstSpeaker->image . '.png');

        // Eliminar la imagen del ponente del almacenamiento
        Storage::disk('public')->delete('img/speakers/' . $firstSpeaker->image . '.png');

        // Verificar que la petición redirige al índice de ponentes y que se muestra el mensaje de éxito
        $response->assertRedirect(route('ponentes.index'));
        $response->assertSessionHas('success', 'Editado Correctamente');

        // Verificar que los datos del ponente hayan sido actualizados en la base de datos
        $imageUpdate = Speaker::first()->image;
        $this->assertDatabaseHas('speakers', array_merge($updateData, ['image' => $imageUpdate, 'networks' => json_encode($network, JSON_UNESCAPED_SLASHES)]));
    }

    /** @test */
    public function remove_the_speaker()
    {
        $this->withoutEvents();

        // Crear un ponente para que se guarde la imagen en storage
        $speaker = [
            'name' => 'John Doe',
            'lastname' => 'apellido',
            'city' => 'monteria',
            'country' =>  'colombia',
            'image' => UploadedFile::fake()->image('post.jpg'),
            'tags' => 'laravel,php,js,css',
            'networks' => null,
        ];

        $response = $this->post('/ponentes', $speaker);

        // Obtener el primer ponente
        $speaker = Speaker::first();

        $response = $this->delete(route('ponentes.destroy', $speaker->id));

        $response->assertRedirect(route('ponentes.index'));

        $response->assertSessionHas('success', 'Eliminado Correctamente');

        // Eliminar la imagen del ponente del almacenamiento
        Storage::disk('public')->delete('img/speakers/' . $speaker->image . '.png');

        // Asegurarse de que el evento se haya eliminado de la base de datos
        $this->assertDatabaseMissing('speakers', ['id' => $speaker->id]);
    }


    /** @test */
    public function page_to_the_speakers()
    {
        // Desactivar eventos
        $this->withoutEvents();

        // Preparar el entorno
        Speaker::factory(10)->create();

        // Ejecutar el método
        $response = $this->get(route('ponentes.index'));

        // Verificar la respuesta HTTP exitosa
        $response->assertSuccessful();

        // Verificar que se cargó la vista correcta
        $response->assertViewIs('admin.ponente.index');

        // Verificar que se pasó la variable 'ponentes' a la vista
        $response->assertViewHas('ponentes');

        // Verificar que se muestran los ponentes en la vista
        $response->assertSeeInOrder(Speaker::paginate(5)->pluck('nombre')->toArray());
    }
}
