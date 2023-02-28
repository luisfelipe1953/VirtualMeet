<?php

namespace App\Services;

class ServicePaginacion {
    public $pagina_actual;
    public $registros_por_pagina;
    public $total_registros;

    public function __construct($pagina_actual = 1, $registros_por_pagina = 10, $total_registros = 0 )
    {
        $this->pagina_actual = (int) $pagina_actual;
        $this->registros_por_pagina = (int) $registros_por_pagina;
        $this->total_registros = (int) $total_registros;
    }

    public function offset() {
        return $this->registros_por_pagina * ($this->pagina_actual - 1);
    }

    public function total_paginas() {
        $total = ceil($this->total_registros / $this->registros_por_pagina);
        $total == 0 ? $total = 1 : $total = $total;
        return $total;
    }

    public function pagina_anterior() {
        $anterior = $this->pagina_actual - 1;
        return ($anterior > 0) ? $anterior : false;
    }

    public function pagina_siguiente() {
        $siguiente = $this->pagina_actual + 1;
        return ($siguiente <= $this->total_paginas()) ? $siguiente : false;
    }

    public function enlace_anterior() {
        $html = '';
        if($this->pagina_anterior()) {
            $html .= "<a href=\"?page={$this->pagina_anterior()}\">&laquo; Anterior </a>";
        }
        return $html;
    }

    public function enlace_siguiente() {
        $html = '';
        if($this->pagina_siguiente()) {
            $html .= "<a href=\"?page={$this->pagina_siguiente()}\">Siguiente &raquo;</a>";
        }
        return $html;
    }

    public function numeros_paginas() {
        $html = '';
        for($i = 1; $i <= $this->total_paginas(); $i++) {
            if($i === $this->pagina_actual ) {
                $html .= "<span class=\"pagina-numero \">{$i}</span>";
            } else {
                $html .= "<a class=\"pagina-numero \" href=\"?page={$i}\">{$i}</a>";
            }
        }

        return $html;
    }
}