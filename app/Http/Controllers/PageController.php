<?php

namespace App\Http\Controllers;

use App\Repositories\EventRepository;
use App\Repositories\SpeakerRepository;

class PageController extends Controller
{
    protected $speaker;
    protected $event;

    public function __construct(SpeakerRepository $speaker, EventRepository $event)
    {
        $this->speaker = $speaker;
        $this->event = $event;
    }

    public function index()
    {
        $events = $this->event->orderBy('time_id','ASC');

        $ponentes = $this->speaker->count();

        $conferences = $this->event->countByCategory(1);

        $workshops = $this->event->countByCategory(2);

        $formattedEvents = $this->formattedEvents($events);
        
        $speakers = $this->speaker->getTake(3);

        return view('paginas.index')->with([
            'eventos' => $formattedEvents,
            'ponentes' => $ponentes,
            'workshops' => $workshops,
            'conferencias' => $conferences,
            'speakers' => $speakers
        ]);
    }

    public function evento()
    {

        return view('paginas.virtualmeet');
    }

    public function conferencias()
    {
        $events = $this->event->orderBy('time_id','ASC');

        $formattedEvents = $this->formattedEvents($events);

        return view('paginas.conferencias-workshops')->with('eventos', $formattedEvents);
    }

    public function speakers()
    {
        $speakers = $this->speaker->all();

        return view('paginas.speakers')->with('speakers', $speakers);
    }
}
