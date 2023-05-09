<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Record;
use Illuminate\Http\Request;
use App\Repositories\EventRepository;
use App\Repositories\RecordRepository;

class DashboardController extends Controller
{           
    protected $record;
    protected $event;

    public function __construct(RecordRepository $record, EventRepository $event)
    {
        $this->record = $record;
        $this->event = $event;
    }

    public function index()
    {
        // Obtener ultimos registros
        $records = $this->record->limit(5);

        // Calcular los ingresos
        $virtuals = $this->record->whereCountRecord(2);
        $inPerson = $this->record->whereCountRecord(1);

        $inCome = ($virtuals * 46.41) + ($inPerson * 189.54);
        
        // Obtener Event con más y menos lugares disponibles
        // limit y take es lo mismo limitan un numero de registros
        $less_available = $this->event->orderByTake('available', 'ASC');
        $more_available =  $this->event->orderByTake('available', 'DESC');

        


        
        return view('admin.dashboard.index')->with([
            'registros' => $records,
            'ingresos' => $inCome,
            'menos_disponibles' => $less_available,
            'mas_disponibles' => $more_available
        ]);
    }
}
