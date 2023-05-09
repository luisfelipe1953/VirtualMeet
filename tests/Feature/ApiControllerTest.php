<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Gift;
use App\Models\Event;
use App\Models\Record;
use App\Models\Speaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'Database\\Seeders\\TimeSeeder',
            'Database\\Seeders\\DaySeeder',
            'Database\\Seeders\\CategorySeeder',
            'Database\\Seeders\\SpeakerSeeder',
        ]);
    }

    /** @test */
    public function api_event()
    {
        $this->withoutEvents();

        $event1 = Event::factory()->create(['day_id' => 1, 'category_id' => 1]);
        $event2 = Event::factory()->create(['day_id' => 1, 'category_id' => 1]);

        $response = $this->post('/api/evento', [
            'day_id' => 1,
            'category_id' => 1
        ]);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'id' => $event1->id,
        ]);
        $response->assertJsonFragment([
            'id' => $event2->id,
        ]);
    }

    /** @test */
    public function api_speakers()
    {   
        $this->withoutEvents();

        $speaker1 = Speaker::factory()->create();
        $speaker2 = Speaker::factory()->create();

        $response = $this->get('/api/ponentes');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $speaker1->name,
            'lastname' => $speaker1->lastname,
            'city' => $speaker1->city,
            'country' => $speaker1->country,
            'image' => $speaker1->image,
            'tags' => $speaker1->tags,
            'networks' => $speaker1->networks
        ]);
        $response->assertJsonFragment([
            'name' => $speaker2->name,
            'lastname' => $speaker2->lastname,
            'city' => $speaker2->city,
            'country' => $speaker2->country,
            'image' => $speaker2->image,
            'tags' => $speaker2->tags,
            'networks' => $speaker2->networks
        ]);
    }

    /** @test */
    public function api_speaker()
    {   
        $this->withoutEvents();

        $speaker = Speaker::factory()->create();

        $response = $this->get('/api/ponente?id=' . $speaker->id);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $speaker->id,
        ]);
       
    }

    /** @test */
    public function api_gift()
    {   
        $this->seed([
            'Database\\Seeders\\UserSeeder',
            'Database\\Seeders\\PackageSeeder',
        ]);

        $gift1 = Gift::factory()->create();
        $gift2 = Gift::factory()->create();
    
        Record::factory()->create(['gift_id' => $gift1->id])->count;
        Record::factory()->create(['gift_id' => $gift2->id])->count;
    
        $response = $this->get('/api/regalos');
    
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $gift1->id,
        ]);
        $response->assertJsonFragment([
            'id' => $gift2->id,
        ]);
    }
}
