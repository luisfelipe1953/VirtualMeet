<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\GiftRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\EventRepository;
use App\Repositories\RecordRepository;

class RecordController extends Controller
{
    protected $record;
    protected $event;
    protected $gift;

    public function __construct(RecordRepository $record, EventRepository $event, GiftRepository $gift)
    {
        $this->record = $record;
        $this->event = $event;
        $this->gift = $gift;
    }

    private function redirectTicket($record)
    {
        if ($record->package_id == Record::TREE || $record->package_id == Record::TWO) {
            return redirect('/ticket?id=' . urlencode($record->token));
        }
    }

    private function responseFalse()
    {
        return response()->json(['resultado' => false]);
    }

    private function getUserId()
    {
        return Auth::user()->id;
    }

    private function getRecordUser()
    {
        return $this->record->where('user_id', $this->getUserId());
    }

    /**
     * retorna la vista  
     *
     * @return void
     */
    public function paquetes()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('success', 'Por favor inicia sesión para continuar.');
        }

        $record = $this->getRecordUser();

        // si el usuario ya tiene registro lo renvia a elegir las conferencias 
        if (isset($record) && $record->package_id == Record::ONE) {
            return redirect('/finalizar-registro/conferencias');
        }

        if ($record) {
            return $this->redirectTicket($record);
        }


        return view('paginas.paquetes');
    }

    /**
     * retorna la vista del boleto con el paquete gratis y se guarda el registro 
     *
     * @return void
     */
    public function paqueteGratis()
    {
        $record = $this->getRecordUser();

        $token = substr(md5(uniqid(rand(), true)), 0, 8);

        $record = $this->record->saveRecord($token, $this->getUserId());

        return redirect('/ticket?id=' . urlencode($record->token))->with('message', 'Registro exitoso.');
    }


    /**
     * se guarda el pago del usuario y se guarda el registro con el paquete
     *
     * @param Request $request
     * @return void
     */
    public function pagar(Request $request)
    {
        try {
            $datos = $request->all();

            if (empty($datos)) {
                return response()->json([]);
            }

            $result = $this->record->payRecord($datos, $this->getUserId());

            return response()->json($result);
        } catch (\Exception $e) {
            $this->responseFalse();
        }
    }


    /**
     * se retorna la vista del boleto con el id
     *
     * @param Request $request
     * @return void
     */
    public function boleto(Request $request)
    {
        $id = $request->id;

        if (!$id || !strlen($id) === 8) {
            return redirect('/')->with('message', 'Vuelva a intentarlo');
        }

        // buscarlo en la BD el id con el token 
        $registro = $this->record->where('token', $id);

        if (!$registro) {
            return redirect('/');
        }

        return view('registro.boletos', compact('registro'));
    }

    /**
     * se retorna la vista para elegir conferencias y regalos
     *
     * @return void
     */
    public function elegirConferencia()
    {
        $record = $this->getRecordUser();

        $recordId = $this->record->eventsRegisteredUsers($record);

        //si hay regalo es porque ya registro los eventos y se redirecciona al boleto
        foreach ($recordId as $recordId) {
            if (isset($recordId)) {
                return redirect('/ticket?id=' . urlencode($record->token)); //
            }
        }

        $events = $this->event->orderBy('time_id', 'ASC');

        $formattedEvents = $this->formattedEvents($events);

        $regalos = $this->gift->all();

        return view('registro.conferencias', [
            'eventos' => $formattedEvents,
            'regalos' => $regalos,
        ]);
    }


    /**
     * se guardan los eventos elegidos y el regalo elegido
     *
     * @param Request $request
     * @return void
     */
    public function postRegistroConferencia(Request $request)
    {
        $record = $this->getRecordUser();

        // Verificar si el registro existe y tiene el paquete adecuado
        if (isset($record) || $record->package_id != Record::ONE) {
            $this->responseFalse();
        }

        // Obtener los eventos seleccionados y verificar que no estén vacíos
        $eventsIds = explode(',', $request->eventos);

        if (empty($eventsIds)) {
            $this->responseFalse();
        }

        // Transacciones
        try {
            DB::beginTransaction();
            // Crear un array para almacenar los eventos seleccionados y evitar consultas innecesarias
            $eventsArray = [];

            // Validar la disponibilidad de los eventos seleccionados
            foreach ($eventsIds as $eventsId) {
                $event = $this->event->get($eventsId);

                // Comprobar que el evento exista y tenga disponibilidad
                if (!isset($event) || $event->available == Record::ZERO) {
                    DB::rollback();
                    $this->responseFalse();
                }
                $eventsArray[] = $event;
            }

            // Actualizar la disponibilidad de los eventos y almacenar los registros en una transacción
            foreach ($eventsArray as $events) {
                $events->available -= 1;

                $this->event->save($events);
                
                $this->record->attachEvent($events->id, $record);
            }

            // Almacenar el regalo
            $record->gift_id = $request->regalo_id ?? 1;

            $this->record->save($record);


            DB::commit();

            return response()->json([
                'resultado' => true,
                'token' => $record->token
            ]);
        } catch (\Exception $e) {

            DB::rollback();

            $this->responseFalse();
        }
    }
}
