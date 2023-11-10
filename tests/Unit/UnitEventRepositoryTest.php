<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Event;
use App\Repositories\EventRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $repo;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'Database\\Seeders\\TimeSeeder', 'Database\\Seeders\\CategorySeeder',
            'Database\\Seeders\\DaySeeder', 'Database\\Seeders\\SpeakerSeeder'
        ]);
        $this->repo = new EventRepository(new Event);

    }
    
    public function test_filter()
    {   
        $this->withoutEvents();

        $event = Event::factory()->create();

        $result = $this->repo->filter($event->day_id, $event->category_id);

        $this->assertEquals($event->id, $result->first()->id);
    }


    public function test_count_by_category()
    {   
        $this->withoutEvents();

        $events = Event::factory(10)->create();

        $event = Event::where('category_id', $events->first()->category_id)->count();

        $result = $this->repo->countByCategory($events->first()->category_id);

        $this->assertEquals($event, $result);
    }


    public function test_order_by()
    {   
        $this->withoutEvents();

        // Preparar el entorno
        Event::factory()->create(['available' => 10]);
        Event::factory()->create(['available' => 15]);
        Event::factory()->create(['available' => 20]);
    
        // Ejecutar el método
        $result = $this->repo->orderBy('available', 'desc');
    
        // Verificar que el resultado tenga 3 elementos
        $this->assertCount(3, $result);
    
        // Verificar que estén ordenados correctamente
        $this->assertEquals(20, $result->first()->available);
        $this->assertEquals(10, $result->last()->available);
    }

    public function test_order_by_take()
    {   
        $this->withoutEvents();

        // Preparar el entorno
        Event::factory()->create(['available' => 10]);
        Event::factory(10)->create();
        Event::factory()->create(['available' => 100]);
    
        // Ejecutar el método
        $result = $this->repo->orderByTake('available', 'desc');
        
        // Verificar que estén ordenados correctamente  
        $this->assertCount(5, $result);
        $this->assertEquals(100, $result->first()->available);
    }


    public function test_get_date_form_create()
    {   
        $this->withoutEvents();
        
        $result = $this->repo->getDateFormCreate();

        $this->assertCount(2, $result['categories']);
        $this->assertCount(2, $result['days']);
        $this->assertCount(8, $result['times']);
    }
}
