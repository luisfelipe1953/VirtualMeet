<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DayRequest;
use App\Repositories\GiftRepository;
use App\Repositories\EventRepository;
use App\Repositories\RecordRepository;
use App\Repositories\SpeakerRepository;

class APIcontroller extends Controller
{
    protected $record;
    protected $event;
    protected $gift;
    protected $speaker;

    public function __construct(RecordRepository $record, EventRepository $event, GiftRepository $gift, SpeakerRepository $speaker)
    {
        $this->record = $record;
        $this->event = $event;
        $this->gift = $gift;
        $this->speaker = $speaker;
    }


    public function evento(DayRequest $request)
    {
        try {
            $eventos = $this->event->filter($request->day_id, $request->category_id);
            
            return response()->json($eventos);
        } catch (\Exception $e) {
            return response()->json([]);
        }
    }

    public function ponentes()
    {
        try {
            $ponentes = $this->speaker->all();

            return response()->json($ponentes);
        } catch (\Exception $e) {
            return response()->json([]);
        }
    }

    public function ponente(Request $request)
    {
        try {
            $id = $request->id;

            $ponente = $this->speaker->get($id);

            return response()->json($ponente, 200, [], JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json([]);
        }
    }

    public function regalos()
    {
        try {
            $gifts = $this->gift->all();

            // otra forma de hacer un foreach los dos son validos
            $gifts->each(function ($gift) {
                $gift->total = $this->record->GiftCountRecord($gift->id);
            });

            return response()->json($gifts);
        } catch (\Exception $e) {
            return response()->json([]);
        }
    }
}
