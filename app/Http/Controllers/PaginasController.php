<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;
use App\Models\Ponentes;
use Illuminate\Support\Facades\Auth;



class PaginasController extends Controller
{
    public function index()
    { 
        $eventos = Eventos::with(['categoria', 'dia', 'hora', 'ponente'])->orderBy('hora_id', 'ASC')->get();
        $ponentes = Ponentes::count();
        $conferencias = Eventos::where('categoria_id', 1)->count();
        $workshops = Eventos::where('categoria_id', 2)->count();

        
        
       
        $eventos_formateados = [];
        foreach($eventos as $evento) {
            if($evento->dia_id == "1" && $evento->categoria_id == "1") {
                $eventos_formateados['conferencias_v'][] = $evento;
            }
            if($evento->dia_id == "2" && $evento->categoria_id == "1") {
                $eventos_formateados['conferencias_s'][] = $evento;
            }
        
            if($evento->dia_id == "1" && $evento->categoria_id == "2") {
                $eventos_formateados['workshops_v'][] = $evento;
            }
        
            if($evento->dia_id == "2" && $evento->categoria_id == "2") {
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }

        $speakers = Ponentes::take(3)->get();

        return view('paginas.index')->with([
            'eventos' => $eventos_formateados,
            'ponentes' => $ponentes,
            'workshops' => $workshops,
            'conferencias' => $conferencias,
            'speakers' => $speakers
        ]);
    }
    public function evento()
    {  
        
        return view('paginas.virtualmeet');
    }
   
    public function conferencias(Request $request)
    {
        $eventos = Eventos::with(['categoria', 'dia', 'hora', 'ponente'])->orderBy('hora_id', 'ASC')->get();
       
        $eventos_formateados = [];
        foreach($eventos as $evento) {
            if($evento->dia_id == "1" && $evento->categoria_id == "1") {
                $eventos_formateados['conferencias_v'][] = $evento;
            }
            if($evento->dia_id == "2" && $evento->categoria_id == "1") {
                $eventos_formateados['conferencias_s'][] = $evento;
            }
        
            if($evento->dia_id == "1" && $evento->categoria_id == "2") {
                $eventos_formateados['workshops_v'][] = $evento;
            }
        
            if($evento->dia_id == "2" && $evento->categoria_id == "2") {
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }

        return view('paginas.conferencias-workshops')->with('eventos', $eventos_formateados);
    }
    
    public function speakers()
    {  
        
        $speakers = Ponentes::all();
        return view('paginas.speakers')->with( 'speakers', $speakers);
    }
}
