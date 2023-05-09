<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use App\Http\Requests\SpeakerRequest;
use App\Contracts\SpeakerRepositoryInterface;

class SpeakerController extends Controller
{
    protected $speaker;

    public function __construct(SpeakerRepositoryInterface $speaker)
    {
        $this->speaker = $speaker;
    }

    public function index()
    {
        $speakers = $this->speaker->paginatedData(5);

        return view('admin.ponente.index')->with([
            'ponentes' => $speakers
        ]);
    }

    
    public function create()
    {
        $speakers = new Speaker;

        return view('admin.ponente.create')->with([
            'ponente' => $speakers,
            'redes' => (object) array_fill_keys(['github', 'tiktok', 'youtube', 'twitter', 'facebook', 'instagram'], ''),
        ]);
    }


    public function store(SpeakerRequest $request)
    {
        $image = $request->file('image');

        $this->speaker->storePonente($request ,$image);

        return redirect('/ponentes')->with('success', 'Agregado Correctamente');;
    }


    public function edit($id)
    {
        $speakers = $this->speaker->get($id);

        $speakers->imagenActual = $speakers->image;

        $networks = json_decode($speakers->networks); 

        return view('admin.ponente.edit')->with([
            'ponente' => $speakers,
            'redes' => $networks
        ]);
    }


    public function update(SpeakerRequest $request, int $id)
    {
        $networks = $this->speaker->get($id);

        $this->speaker->updatePonente($networks, $request);

        return redirect('/ponentes')->with('success', 'Editado Correctamente');
    }


    public function destroy($id)
    {
        $networks = $this->speaker->get($id);

        $this->speaker->deletePonente($networks);

        $this->speaker->destroy($networks);

        return redirect('/ponentes')->with('success', 'Eliminado Correctamente');
    }
}
