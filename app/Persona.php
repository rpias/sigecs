<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    // Hace referencia al nombre de la tabla en la DB
    protected $table = 'personas';

    // Los campos declarados aqui son impresindibles
    // llenar para crear un registro
    protected $fillable = ['cedula',
    'primer_nombre',
    'segundo_nombre',
    'primer_apellido',
    'segundo_apellido',
    'actuallizado',
    'id_usuario',
    'sexo',
    'fecha_nac',
    'obs',
    'activo'];

    // Los campos declarados aqui nunca se pasan
    // para crear un registro
    protected $guarded = ['id_persona'];

    // Si la Clave Primaria de una Tabla
    // no se llama 'id' hay que declararla
    // obligatoriamente AQUI
    protected $primaryKey = 'id_persona';

    // Esta declaracion hace que no se
    // agregen a las consultas de
    // INSERT y UPDATE los campos
    // created_at y update_at
    public $timestamps = false;


}
