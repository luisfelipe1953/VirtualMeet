<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Speaker;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Http\UploadedFile;
use App\Repositories\SpeakerRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitSpeakerRopositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $repo;
    protected $serviceImage;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = new SpeakerRepository(new Speaker());
        $this->serviceImage  = new ImageService;
    }

    /** @test */
    public function it_counts_speakers()
    {
        Speaker::factory(3)->create();

        $count = $this->repo->count();

        $this->assertEquals(3, $count);
    }

    /** @test */
    public function it_gets_a_number_of_speakers()
    {
        Speaker::factory()->count(5)->create();

        $speakers = $this->repo->getTake(3);

        $this->assertCount(3, $speakers);
    }

    /** @test */
    public function it_stores_a_speaker()
    {
        $fakeImage = UploadedFile::fake()->image('test.jpg');

        $request = New Request([
            'name' => 'John Doe',
            'lastname' => 'apellido',
            'city' => 'Monteria',
            'country' => 'Colombia',
            'tags' => 'laravel,php',
            'networks' => [
                'twitter' => 'johndoe',
                'github' => 'johndoe',
                'linkedin' => 'johndoe',
            ]
        ]);

        $this->repo->storePonente($request, $fakeImage);

        $this->assertDatabaseHas('speakers', [
            'name' => 'John Doe',
            'lastname' => 'apellido',
            'city' => 'Monteria',
            'country' => 'Colombia',
            'tags' => 'laravel,php',
            'networks' => json_encode($request->networks, JSON_UNESCAPED_SLASHES),
        ]);

    }

    /** @test */
    public function it_updates_a_speaker()
    {
        $speaker = Speaker::factory()->create();

        $request = New Request([
            'name' => 'John (Updated)',
            'lastname' => 'Doe (Updated)',
            'city' => 'Medellin',
            'image' => UploadedFile::fake()->image('test.jpg'),
            'country' => 'Colombia',
            'tags' => 'laravel,php,js',
            'networks' => [
                'twitter' => 'johndoe',
                'github' => 'johndoe',
                'linkedin' => 'johndoe',
            ],
        ]);

        $this->repo->updatePonente($speaker, $request);

        $this->assertDatabaseHas('speakers', [
            'id' => $speaker->id,
            'name' => 'John (Updated)',
            'lastname' => 'Doe (Updated)',
            'city' => 'Medellin',
            'country' => 'Colombia',
            'tags' => 'laravel,php,js',
            'networks' => json_encode($request->networks, JSON_UNESCAPED_SLASHES),
        ]);
    }

    //  /** @test */
    // public function it_deletes_a_speaker()
    // {
    //     $speaker = Speaker::factory()->create();

    //     $this->repo->deletePonente($speaker);



    // }
}
