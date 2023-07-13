<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoContable extends Model
{
    protected $table = 'contable_movimientos';

    protected $fillable = ['id_movimiento',
    'id_rubro',
    'fecha_mov',
    'fecha_doc',
    'nro_doc',
    'detalle',
    'importe',
    'obs',
    'habilitado',
    'modificado',
    'id_usuario_mod'];

    protected $guarded = ['id_movimiento'];

    protected $primaryKey = 'id_movimiento';

    public $timestamps = false;

    public $reglas = [
        'select_sub_rubro' => 'required',
        'txt_fecha_mov' => 'required',
        'txt_detalle' => 'required',
        'txt_importe' => 'required',
    ];
 
    public $mensajes = [
        'select_sub_rubro.required' => 'Debe seleccionar un SubRubro',
        'txt_fecha_mov.required' => 'Debe ingresar la Fecha del Movimiento',
        'txt_detalle.required' => 'Debe ingresar el Detalle del Movimiento',
        'txt_importe.required' => 'Debe ingresar el Importe del Movimiento',
    ];

}
