<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estadistica extends Model
{
     // Hace referencia al nombre de la tabla en la DB
     protected $table = 'registro_estadistica';

     // Los campos declarados aqui son impresindibles
     // llenar para crear un registro
     protected $fillable = [
     'id_usuario',
     'anio',
     'mes',
     'importe',
     'IP'];
 
     // Los campos declarados aqui nunca se pasan
     // para crear un registro
     protected $guarded = ['id_registro_estadistica'];
 
     // Si la Clave Primaria de una Tabla
     // no se llama 'id' hay que declararla
     // obligatoriamente AQUI
     protected $primaryKey = 'id_registro_estadistica';
 
     // Esta declaracion hace que no se
     // agregen a las consultas de
     // INSERT y UPDATE los campos
     // created_at y update_at
     public $timestamps = false;
 
}
