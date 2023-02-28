<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventos;
use App\Models\Categorias;
use App\Models\Dias;
use App\Models\Horas;
use App\Models\Eventos;
use Illuminate\Http\Request;
use App\Services\ServicePaginacion;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $pagina_actual = request('page', 1);

        $registros_por_pagina = 8;
    
        $total_registros = Eventos::count();
    
        $paginacion = new ServicePaginacion($pagina_actual, $registros_por_pagina, $total_registros);
    
        $offset = $paginacion->offset();
    
        $eventos = Eventos::with(['categoria', 'dia', 'hora', 'ponente'])
                          ->skip($offset)
                          ->take($registros_por_pagina)
                          ->get();
    
        return view('admin.eventos.index', [
            'eventos' => $eventos,
            'paginacion' => $paginacion
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categorias::all();
        $dias = Dias::all();
        $horas = Horas::all();

        return view('admin.eventos.create')->with([
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => new Eventos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventos $request)
    {
        $eventos = new Eventos();

        $eventos->nombre = $request->input('nombre');
        $eventos->descripcion = $request->input('descripcion');
        $eventos->categoria_id = $request->input('categoria_id');
        $eventos->dia_id = $request->input('dia_id');
        $eventos->hora_id = $request->input('hora_id');
        $eventos->ponente_id = $request->input('ponente_id');
        $eventos->disponibles = $request->input('disponibles');

        $eventos->save();

       
        return redirect()->route('eventos.index')->with('success', 'Agregado Correctamente');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = Categorias::all();
        $dias = Dias::all();
        $horas = Horas::all();
        $eventos = Eventos::find($id);
      

        return view('admin.eventos.edit')->with([
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $eventos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $eventos = Eventos::find($id);
        
        $eventos->nombre = $request->input('nombre');
        $eventos->descripcion = $request->input('descripcion');
        $eventos->categoria_id = $request->input('categoria_id');
        $eventos->dia_id = $request->input('dia_id');
        $eventos->hora_id = $request->input('hora_id');
        $eventos->ponente_id = $request->input('ponente_id');
        $eventos->disponibles = $request->input('disponibles');

        //para cancelar la fecha de creacion esta es una forma otra es directamenten en el modelo
        $eventos->timestamps = false;
        $eventos->save();
        $eventos->timestamps = true;

        return redirect()->route('eventos.index')->with('success', 'Editado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evento = Eventos::find($id);
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Eliminado Correctamente');
    }
}
