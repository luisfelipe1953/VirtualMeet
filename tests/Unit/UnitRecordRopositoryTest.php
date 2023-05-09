<?php

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Record;
use App\Repositories\RecordRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitRecordRopositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $repo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'Database\\Seeders\\PackageSeeder',
            'Database\\Seeders\\GiftSeeder',
            'Database\\Seeders\\TimeSeeder',
            'Database\\Seeders\\DaySeeder',
            'Database\\Seeders\\SpeakerSeeder',
            'Database\\Seeders\\CategorySeeder',
            'Database\\Seeders\\UserSeeder',
        ]);
        $this->repo = new RecordRepository(new Record);
    }

    /** @test */
    public function save_record_saves_a_new_record()
    {
        // Create a user
        $user = User::factory()->create();

        // Call the saveRecord method with the user ID
        $record = $this->repo->saveRecord('12345678', $user->id);

        // Assert that the record was created successfully
        $this->assertNotNull($record->id);
        $this->assertEquals(3, $record->package_id);
        $this->assertEquals('', $record->payment_id);
        $this->assertEquals('12345678', $record->token);
        $this->assertEquals($user->id, $record->user_id);
    }

    /** @test */
    public function pay_record()
    {
        // Create a user
        $user = User::factory()->create();

        $datos = [
            'package_id' => 1,
            'payment_id' => '112233144',
        ];

        // Ejecutamos el método a probar
        $result = $this->repo->payRecord($datos, $user->id);

        // Verificamos que se haya creado un registro con los datos proporcionados
        $this->assertEquals($datos['package_id'], $result->package_id);
        $this->assertEquals($datos['payment_id'], $result->payment_id);
        $this->assertEquals($user->id, $result->user_id);
    }

    /** @test */
    public function attach_event()
    {
        // Crear una instancia del modelo Record y guardarla en la base de datos
        $user = User::factory()->create();

        // Creamos un registro para el usuario
        $record = Record::factory()->create(
            [
                'user_id' => $user->id,
                'package_id' => Record::ONE,
            ]
        );

        // Crear una instancia del modelo Event y guardarla en la base de datos
        $events = Event::factory(5)->create();

        $eventIds = $events->pluck('id');

        // Llamar al método attachEvent pasando el ID del evento y la instancia del registro
        foreach ($eventIds as $eventId) {
            $this->repo->attachEvent($eventId, $record);
        }

        $attachedEventIds = $record->event->pluck('id');

        $this->assertEquals($eventIds, $attachedEventIds);
    }

    /** @test */
    public function gift_count()
    {
        // Crear una instancia del modelo Record y guardarla en la base de datos
        $user = User::factory()->create();

        // Creamos un registro para el usuario
        Record::factory()->create(
            [
                'user_id' => $user->id,
                'package_id' => Record::ONE,
                'gift_id' => 1,

            ]
        );


        // Ejecutamos la función GiftCountRecord con idGift=1
        $count = $this->repo->GiftCountRecord(1);
        
        // Comprobamos que el resultado es 1
        $this->assertEquals(1, $count);
    }

    /** @test */
    public function registered_user_events()
    {   
        $this->seed([
            'Database\\Seeders\\RecordSeeder',
        ]);

        $record = Record::find(3);
 
        // Agregar un evento relacionado al registro
        $events = Event::factory(2)->create();

        foreach ($events as $event) {
            $record->event()->attach($event);
        }
            
        // Llamar al método que se está probando
        $result = $this->repo->eventsRegisteredUsers($record);

        $record = $record->event->toArray();

        // Asegurarse de que el resultado contenga el evento relacionado
        for ($i = 0; $i < count($result); $i++) {
            $this->assertEquals($result[$i]['id'], $record[$i]['pivot']['record_id']);
        }
    }

    /** @test */
    public function it_can_limit_results()
    {   
        $this->seed([
            'Database\\Seeders\\RecordSeeder',
        ]);

        $limit = 5;

        $results = $this->repo->limit($limit);

        $this->assertCount($limit, $results);
    }

    /** @test */
    public function it_can_count_records_by_package_id()
    {   
        $this->seed([
            'Database\\Seeders\\RecordSeeder',
        ]);

        $records = Record::all();

        $record = Record::where('package_id', $records->first()->package_id)->count();

        $result = $this->repo->whereCountRecord($records->first()->package_id);

        $this->assertEquals($record, $result);
    }
}
