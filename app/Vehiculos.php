<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model
{
    protected $table = 'vehiculos';

    /*
    protected $fillable = ['id_tipo_vehiculo', 'matricula', 'marca', 'modelo', 'anio', 'obs', 'id_usuario'];

    public $reglas = [
        'select_unidad' => 'required',

    ];

    public $mensajes = [
        'select_unidad.required' => 'Debe seleccionar la unidad',

    ];
    */
}
