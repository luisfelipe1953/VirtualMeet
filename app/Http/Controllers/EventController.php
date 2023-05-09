<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Repositories\EventRepository;

class EventController extends Controller
{
    protected $event;

    public function __construct(EventRepository $event)
    {
        $this->event = $event;
    }

    public function index()
    {   
       $event = $this->event->paginatedData(5);
    
        return view('admin.eventos.index', [
            'eventos' => $event
        ]);
    }

    public function create()
    {
        $data = $this->event->getDateFormCreate();


        return view('admin.eventos.create')->with([
            'data' => $data,
            'evento' => new Event,
        ]);
    }   

    public function store(EventRequest $request)
    {
        $event = new Event($request->validated());

        $this->event->save($event);

        return redirect()->route('eventos.index')->with('success', 'Agregado Correctamente');
    }

    public function edit($id)
    {   
        $events = $this->event->get($id);

        $data = $this->event->getDateFormCreate();
      
        return view('admin.eventos.edit')->with([
            'data' => $data,
            'evento' => $events
        ]);
    }

    public function update(EventRequest $request, $id)
    {   
        $event = $this->event->get($id); 

        $event->fill($request->validated());

        $this->event->save($event);

        return redirect()->route('eventos.index')->with('success', 'Editado Correctamente');
    }

    public function destroy($id)
    {   
        $event = $this->event->get($id); 

        $this->event->destroy($event);
        
        return redirect()->route('eventos.index')->with('success', 'Eliminado Correctamente');
    }
}
