<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table = 'expedientes';

    public $reglas = [
        'select_unidad' => 'required',
    ];
 
    public $mensajes = [
        'select_unidad.required' => 'Debe seleccionar la unidad',
    ];

}
