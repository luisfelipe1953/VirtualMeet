<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Registros;
use App\Models\Eventos;
use App\Models\EventosRegistros;
use App\Models\Regalos;
use Illuminate\Support\Facades\DB;



class RegistroController extends Controller
{

    public function paquetes()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('success', 'Por favor inicia sesión para continuar.');
        }

        $userId = Auth::user()->id;
        $registros = Registros::with('paquete')->where('usuario_id', $userId)->get();


        // si el usuario ya tiene registro lo renvia al boleto 
        foreach ($registros as $registro) {
            if (isset($registro) && ($registro->paquete_id == "3" || $registro->paquete_id == "2")) {
                return redirect('/boleto?id=' . urlencode($registro->token));
            }
        }

        // si el usuario ya tiene registro lo renvia a elegir las conferencias 
        foreach ($registros as $registro) {
            if (isset($registro) && $registro->paquete_id == "1") {
                return redirect('/finalizar-registro/conferencias');
            }
        }

        return view('paginas.paquetes');
    }


    public function paqueteGratis()
    {   
        
        // ya estoy usando los permisos pero si no lo estuiviera utilizando uso esto
        // if (!Auth::check()) {
        //     return redirect('/login')->with('success', 'Por favor inicia sesión para continuar.');
        // }
        $userId = Auth::user()->id;

        $registros = Registros::with('paquete')->where('usuario_id', $userId)->get();

        //mira si ya existe el ticket si esxite lo redirecciona al ticket
        foreach ($registros as $registro) {
            if ($registro && $registro->paquete_id == '3') {
                return redirect('/boleto?id=' . urlencode($registro->token));
            }
        }

        $token = substr(md5(uniqid(rand(), true)), 0, 8);

        //al hacer algo asi que no se teolvide modificar $datatimes
        $datos = [
            'paquete_id' => 3,
            'pago_id' => '',
            'token' => $token,
            'usuario_id' => Auth::user()->id
        ];

        $registros = new Registros($datos);

        if ($registros->save()) {
            return redirect('/boleto?id=' . urlencode($registros->token))->with('message', 'Registro exitoso.');
        }
    }



    public function pagar(Request $request)
    {
        //Validar que Post no venga vacio
        if (empty($request->all())) {
            return response()->json([]);
        }
        $userId = Auth::user()->id;

        // Crear el registro

        $datos = $request->all();
        $datos['token'] = substr(md5(uniqid(rand(), true)), 0, 8);
        $datos['usuario_id'] = $userId;
        try {
            $registro = new Registros($datos);
            $resultado = $registro->save();
            return response()->json($resultado);
        } catch (\Throwable $th) {
            return response()->json([
                'resultado' => 'error'
            ]);
        }
    }

    public function boleto(Request $request)
    {

        $id = $request->get('id');

        if (!$id || !strlen($id) === 8) {
            return redirect('/')->with('message', 'Vuelva a intentarlo');
        }
        // buscarlo en la BD el id con el token 
        $registro = Registros::with('usuario', 'paquete')->where('token', $id)->firstOrFail();

        if (!$registro) {
            return redirect('/');
        }

        return view('registro.boletos')->with('registro', $registro);
    }





    public function elegirConferencia()
    {   

        // ya estoy usando los permisos pero si no lo estuiviera utilizando uso esto
        // if (!Auth::check()) {
        //     return redirect('/login')->with('success', 'Por favor inicia sesión para continuar.');
        // }

        // Validar que el usuario tenga el plan presencial
        $userId = Auth::user()->id;

        $registros = Registros::with('paquete')->where('usuario_id', $userId)->get();

    
        foreach ($registros as $registro) {
            if ( isset($registro->regalos_id) || isset($registro->paquete_id) != "1") {
                return redirect('/boleto?id=' . urlencode($registro->token));
            }
        }

        foreach ($registros as $registro) {
            if ($registro && $registro->paquete_id == '2') {
                return redirect('/boleto?id=' . urlencode($registro->token));
            }
        }

        if (isset($registro->paquete_id) != "1") {
            return redirect('/');
        }



        $eventos = Eventos::with(['categoria', 'dia', 'hora', 'ponente'])->orderBy('hora_id', 'ASC')->get();

        $eventos_formateados = [];
        foreach ($eventos as $evento) {
            if ($evento->dia_id == "1" && $evento->categoria_id == "1") {
                $eventos_formateados['conferencias_v'][] = $evento;
            }
            if ($evento->dia_id == "2" && $evento->categoria_id == "1") {
                $eventos_formateados['conferencias_s'][] = $evento;
            }

            if ($evento->dia_id == "1" && $evento->categoria_id == "2") {
                $eventos_formateados['workshops_v'][] = $evento;
            }

            if ($evento->dia_id == "2" && $evento->categoria_id == "2") {
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }

        $regalos = Regalos::all();

        return view('registro.conferencias', [
            'eventos' => $eventos_formateados,
            'regalos' => $regalos,
        ]);
    }

    public function postRegistroConferencia(Request $request)
    {
        // autenticar primero si a iniciado session 
        if (!Auth::check()) {
            return redirect('/login')->with('success', 'Por favor inicia sesión para continuar.');
        }


        // separar en array 
        $eventos = explode(',', $request->input('eventos'));

        if (empty($eventos)) {
            return response()->json(['resultado' => false]);
        }

        // Revisar que el usuario este autenticado 
        $userId = Auth::user()->id;

        //Obtener el registro de usuario 
        $registro = Registros::with('paquete')->where('usuario_id', $userId)->first();



        if (!isset($registro) || $registro->paquete_id != "1") {
            return response()->json(['resultado' => false]);
        }

        // transacciones
        try {
            DB::beginTransaction();
            // se crea un arrray para no hacer varias consultas
            $eventos_array = [];

            // Validar la disponibilidad de los eventos seleccionados
            foreach ($eventos as $evento_id) {
                // lockForUpdate Esto evita que otros procesos o hilos modifiquen el evento seleccionado mientras se realiza la transacción
                $evento = Eventos::lockForUpdate()->find($evento_id);
                // Comprobar que el evento exista y tenga disponibilidad
                if (!isset($evento) || $evento->disponibles == "0") {
                    DB::rollback();
                    return response()->json(['resultado' => false]);
                }
                $eventos_array[] = $evento;
            }
            // Actualizar la disponibilidad de los eventos y almacenar los registros en una transacción
            foreach ($eventos_array as $evento) {
                $evento->disponibles -= 1;
                $evento->save();

                $datos = [
                    'evento_id' => (int) $evento->id,
                    'registro_id' => (int) $registro->id
                ];

                $registro_usuario = new EventosRegistros($datos);
                $registro_usuario->save();
            }

            // Almacenar el regalo
            $registro->regalos_id = $request->input('regalo_id') ?? 1;
            $registro->save();

            DB::commit();

            return response()->json([
                'resultado' => true,
                'token' => $registro->token
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['resultado' => false]);
        }
    }
}
