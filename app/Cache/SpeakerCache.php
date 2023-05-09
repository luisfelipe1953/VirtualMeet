<?php

namespace App\Cache;

use App\Cache\BaseCache;
use App\Repositories\SpeakerRepository;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\SpeakerRepositoryInterface;

class SpeakerCache extends BaseCache implements SpeakerRepositoryInterface
{

    protected $speakerRepository;

    public function __construct(SpeakerRepository $speakerRepository)
    {
        parent::__construct($speakerRepository, 'ponente');
    }

    public function all()
    {
        return $this->cache::remember($this->key, self::time, function () {
            return $this->repository->all();
        });
    }

    public function get($id)
    {
        return $this->repository->get($id);
    }

    public function save(Model $model)
    {
        $this->forget($this->key);
        return $this->repository->save($model);
    }

    public function destroy(Model $model)
    {
        $this->forget($this->key);
        return $this->repository->destroy($model);
    }

    public function paginatedData(int $paginateNum)
    {
        return $this->repository->paginatedData($paginateNum);
    }

    public function storePonente($request, $image)
    {
        $this->forget($this->key);
        return $this->repository->storePonente($request, $image);
    }

    public function updatePonente($ponente, $request)
    {   
        $this->forget($this->key);
        return $this->repository->updatePonente($ponente, $request);
    }

    public function deletePonente($ponente)
    {   
        $this->forget($this->key);
        return $this->repository->deletePonente($ponente);
    }
}
