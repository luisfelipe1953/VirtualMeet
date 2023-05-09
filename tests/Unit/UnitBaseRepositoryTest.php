<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Mockery as m;

class UnitBaseRepositoryTest extends TestCase
{   
    protected $model;
    protected $repo;

    public function setUp(): void
    {
        parent::setUp();

        $this->model = m::mock(Model::class);
        $this->repo = new BaseRepository($this->model);
    }

    public function tearDown(): void
    {
        m::close();
    }

    public function test_all()
    {
        $this->model
            ->shouldReceive('get')
            ->once()
            ->andReturn(['item1', 'item2']);

        $result = $this->repo->all();

        $this->assertEquals(['item1', 'item2'], $result);
    }

    public function test_paginated_data()
    {
        $this->model
            ->shouldReceive('paginate')
            ->once()
            ->with(10)
            ->andReturn(['item1', 'item2']);

        $result = $this->repo->paginatedData(10);

        $this->assertEquals(['item1', 'item2'], $result);
    }

    public function test_get()
    {
        $this->model
            ->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn('item1');

        $result = $this->repo->get(1);

        $this->assertEquals('item1', $result);
    }

    public function test_where()
    {
        $this->model
            ->shouldReceive('where')
            ->once()
            ->with('column', 'value')
            ->andReturnSelf()
            ->shouldReceive('first')
            ->once()
            ->andReturn('item1');

        $result = $this->repo->where('column', 'value');

        $this->assertEquals('item1', $result);
    }

    public function test_save()
    {
        $model = m::mock(Model::class);
        $model
            ->shouldReceive('save')
            ->once();

        $result = $this->repo->save($model);

        $this->assertEquals($model, $result);
    }

    public function test_destroy()
    {
        $model = m::mock(Model::class);
        $model
            ->shouldReceive('delete')
            ->once();

        $result = $this->repo->destroy($model);

        $this->assertEquals($model, $result);
    }
}
