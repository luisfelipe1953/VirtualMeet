<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;
use App\Models\Ponentes;
use App\Models\Regalos;
use App\Models\Registros;

class APIcontroller extends Controller
{
    public function evento(Request $request){
        
        $request->validate([
            'dia_id' => 'integer',
            'categoria_id' => 'integer',
        ]);
    
        $dia_id = $request->input('dia_id');
        $categoria_id = $request->input('categoria_id');
    
        // Consultar la base de datos
        $eventos = Eventos::filtrar($dia_id, $categoria_id)->get() ?? [];
        return response()->json($eventos);

    }

    public function ponentes(){
        $ponentes = Ponentes::all();
        return response()->json($ponentes);

    }

    public function ponente(Request $request){
        $request->validate([
            'id' => 'integer'
        ]);

        $id = $request->get('id');
        $ponente = Ponentes::find($id) ?? [];
        return response()->json($ponente, 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function regalos(){
        $regalos = Regalos::all();

        // otra forma de hacer un foreach los dos son validos
        $regalos->each(function($regalo) {
            $regalo->total = Registros::where(['regalos_id' => $regalo->id, 'paquete_id' => "1"])->count();
        });
    
        return response()->json($regalos);
    }
    
}
