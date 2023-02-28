<?php

namespace App\Http\Controllers;

use App\Models\Registros;
use App\Services\ServicePaginacion;
use Illuminate\Http\Request;

class RegistradosController extends Controller
{
    public function index(){

        $pagina_actual = request('page', 1);

        $registros_por_pagina = 5;

        $total_registros = Registros::count();

        $paginacion = new ServicePaginacion($pagina_actual, $registros_por_pagina, $total_registros);

        $offset = $paginacion->offset();

        $registros = Registros::skip($offset)->take($registros_por_pagina)->get();

        

        return view('admin.registrados.index')->with([
            'registros' => $registros,
            'paginacion' => $paginacion
        ]);
    }
}
