<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registros extends Model
{
    use HasFactory;

    public function paquete()
    {
        return $this->belongsTo(Paquetes::class);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public $timestamps = false;

    protected $fillable = ['paquete_id', 'pago_id', 'token', 'usuario_id'];
}
