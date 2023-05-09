<?php

namespace App\Repositories;

use App\Models\Record;
use App\Repositories\BaseRepository;

class RecordRepository extends BaseRepository
{
    public $model;

    public function __construct(Record $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function saveRecord($token, $userId)
    {
        $record = $this->model::create([
            'package_id' => 3,
            'payment_id' => '',
            'token' => $token,
            'user_id' => $userId
        ]);

        return $record;
    }
    
    public function payRecord($datos, $userId)
    {
            $datos['token'] = substr(md5(uniqid(rand(), true)), 0, 8);

            $datos['user_id'] = $userId;

            return $this->model::create($datos);
    }

    public function attachEvent($eventsId, $record){
        $record->event()->attach($eventsId);
    }

    public function GiftCountRecord($idGift){
        return $this->model::where(['gift_id' => $idGift, 'package_id' => "1"])->count();
    }

    public function eventsRegisteredUsers($record){
        return  $this->model::whereHas('event', function ($query) use ($record) {
            $query->where('record_id', $record->id);
        })->get();
    }
    
    public function limit(int $int){
        return  $this->model::limit($int)->get();
    }

    
    public function whereCountRecord(int $idPackage_id)
    {
        return $this->model::where('package_id', $idPackage_id)->count();
    }
}
