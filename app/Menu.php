<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
       // Hace referencia al nombre de la tabla en la DB
       protected $table = 'menu';

       // Los campos declarados aqui son impresindibles
       // llenar para crear un registro
       protected $fillable = ['menu',
       'ruta',
       'hijo_de',
       'activo',
       'IP',
       'id_usuario'];
   
       // Los campos declarados aqui nunca se pasan
       // para crear un registro
       protected $guarded = ['id_menu'];
   
       // Si la Clave Primaria de una Tabla
       // no se llama 'id' hay que declararla
       // obligatoriamente AQUI
       protected $primaryKey = 'id_menu';
   
       // Esta declaracion hace que no se
       // agregen a las consultas de
       // INSERT y UPDATE los campos
       // created_at y update_at
       public $timestamps = false;
}
