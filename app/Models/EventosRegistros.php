<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventosRegistros extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['evento_id', 'registro_id'];
}
