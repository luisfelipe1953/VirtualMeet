<?php

namespace App\Repositories;

use App\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;


class BaseRepository implements BaseRepositoryInterface
{
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->get();
    }
    
    public function paginatedData(int $paginateNum)
    {
        return $this->model::paginate($paginateNum);
    }
    

    public function get($id)
    {
        return $this->model->find($id);
    }

    public function where(string $column, string $value)
    {
        return  $this->model::where($column, $value)->first();
    }

    public function save(Model $model)
    {
        $model->save();

        return $model;
    }

    public function destroy(Model $model)
    {
        $model->delete();

        return $model;
    }
}
