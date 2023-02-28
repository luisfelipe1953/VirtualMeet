<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Eventos extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function scopeFiltrar($query, $dia_id, $categoria_id)
    {
        return $query->where('dia_id', $dia_id)
            ->where('categoria_id', $categoria_id);
    }

    public function categoria()
    {
        return $this->belongsTo(Categorias::class);
    }

    public function hora()
    {
        return $this->belongsTo(Horas::class);
    }

    public function ponente()
    {
        return $this->belongsTo(Ponentes::class);
    }

    public function dia()
    {
        return $this->belongsTo(Dias::class);
    }
}
