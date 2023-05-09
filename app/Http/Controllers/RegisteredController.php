<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Services\ServicePaginacion;
use Illuminate\Http\Request;

class RegisteredController extends Controller
{
    public function index(){

        $pagina_actual = request('page', 1);

        $registros_por_pagina = 5;

        $total_registros = Record::count();

        $paginacion = new ServicePaginacion($pagina_actual, $registros_por_pagina, $total_registros);

        $offset = $paginacion->offset();

        $registros = Record::skip($offset)->take($registros_por_pagina)->get();

        //ya se que existe un metodo de eloquent para esto solo que lo hice, 
        //cuando no sabia que lo habia, me costo hacerlo asi que quiero que lo vean
        
        return view('admin.registrados.index')->with([
            'registros' => $registros,
            'paginacion' => $paginacion
        ]);
    }
}
