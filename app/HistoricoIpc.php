<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoIpc extends Model
{
   protected $table = 'historico_ipc';

   
    // Los campos declarados aqui son impresindibles
    // llenar para crear un registro
    protected $fillable = ['mes',
    'anio',
    'indice'];

    // Los campos declarados aqui nunca se pasan
    // para crear un registro
    protected $guarded = ['id'];

    // Si la Clave Primaria de una Tabla
    // no se llama 'id' hay que declararla
    // obligatoriamente AQUI
    protected $primaryKey = 'id';

    // Esta declaracion hace que no se
    // agregen a las consultas de
    // INSERT y UPDATE los campos
    // created_at y update_at
    public $timestamps = false;

}
