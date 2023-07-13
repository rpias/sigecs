<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioRol extends Model
{
      // Hace referencia al nombre de la tabla en la DB
      protected $table = 'usuarios_roles';

      // Los campos declarados aqui son impresindibles
      // llenar para crear un registro
      protected $fillable = ['id_usuario', 'id_rol', 'habilitado'];
  
      // Los campos declarados aqui nunca se pasan
      // para crear un registro
      protected $guarded = ['id_usuario_rol'];
  
      // Si la Clave Primaria de una Tabla
      // no se llama 'id' hay que declararla
      // obligatoriamente AQUI
      protected $primaryKey = 'id_usuario_rol';
  
      // Esta declaracion hace que no se
      // agregen a las consultas de
      // INSERT y UPDATE los campos
      // created_at y update_at
      public $timestamps = false;
}
