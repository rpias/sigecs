<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad_Titular extends Model
{
    protected $table = 'unidades_titulares';

    protected $fillable = ['id_titular',
    'id_unidad',
    'pertenece_recibo',
    'pertenece_padron',
    'activo',
    'obs',
    'modificado',
    'id_usuario'];

    protected $guarded = ['id_unidad_titular'];

    protected $primaryKey = 'id_unidad_titular';

    public $timestamps = false;
}
