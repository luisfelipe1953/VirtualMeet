<?php

namespace App\Repositories;

use App\Models\Speaker;
use App\Services\ImageService;
use App\Repositories\BaseRepository;
use App\Contracts\SpeakerRepositoryInterface;

class SpeakerRepository extends BaseRepository implements SpeakerRepositoryInterface
{
    public $model;
    protected $service;

    public function __construct(Speaker $model)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->service = new ImageService;
    }

    public function count()
    {
        return $this->model::count();
    }
    public function getTake(int $getNum)
    {
        return $this->model::take($getNum)->get();
    }


    public function storePonente($request, $image)
    {   
        $nameImage = $this->service->create($image);

        Speaker::create([
            'image' => $nameImage,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'city' => $request->city,
            'country' => $request->country,
            'tags' => $request->tags,
            'networks' => json_encode($request->networks, JSON_UNESCAPED_SLASHES),
        ]);
    }

    public function updatePonente($speaker, $request)
    {   
        $imagePonente = $speaker->image;

        if ($request->file('image')) {
            $nameImage = $this->service->update($imagePonente, $request->file('image'));

            $speaker->image = $nameImage;
        } else {
            $speaker->image = $imagePonente;
        }
        $speaker->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'city' => $request->city,
            'country' => $request->country,
            'tags' => $request->tags,
            'networks' => json_encode($request->networks, JSON_UNESCAPED_SLASHES),
        ]);
    }
    public function deletePonente($speaker)
    {   
        $this->service->delete($speaker->image);
    }
}
