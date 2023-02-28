<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registros;
use App\Models\Eventos;
use App\Models\User;

class DashboardController extends Controller
{   
    public function index()
    {
        // Obtener ultimos registros
        $registros = Registros::limit(5)->get();

        //obtener usuarios de tablas relacionadas
        $registro = Registros::with('usuario')->first();
     
        // Calcular los ingresos
        $virtuales = Registros::where('paquete_id', 2)->count();
        $presenciales = Registros::where('paquete_id', 1)->count();

        $ingresos = ($virtuales * 46.41) + ($presenciales * 189.54);
        


        // Obtener eventos con más y menos lugares disponibles
        // limit y take es lo mismo limitan un numero de registros
        $menos_disponibles = Eventos::orderBy('disponibles', 'ASC')->take(5)->get();
        $mas_disponibles =  Eventos::orderBy('disponibles', 'DESC')->take(5)->get();


        return view('admin.dashboard.index')->with([
            'registros' => $registros,
            'ingresos' => $ingresos,
            'menos_disponibles' => $menos_disponibles,
            'mas_disponibles' => $mas_disponibles
        ]);
    }
}
