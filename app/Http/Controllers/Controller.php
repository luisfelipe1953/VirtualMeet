<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function formattedEvents($events)
    {

        $formattedEvents = [
        ];

        foreach ($events as $event) {
            if ($event->day_id == "1" && $event->category_id == "1") {
                $formattedEvents['conferencias_v'][] = $event;
            }
            if ($event->day_id == "2" && $event->category_id == "1") {
                $formattedEvents['conferencias_s'][] = $event;
            }

            if ($event->day_id == "1" && $event->category_id == "2") {
                $formattedEvents['workshops_v'][] = $event;
            }

            if ($event->day_id == "2" && $event->category_id == "2") {
                $formattedEvents['workshops_s'][] = $event;
            }
        }
        return $formattedEvents;
    }
}
