<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cobranza extends Model
{
    protected $table = 'recibos';

    protected $fillable = ['id_recibo',
    'nro_recibo',
    'id_factura',
    'id_forma_pago',
    'serie_recibo',
    'importe',
    'obs',
    'creado',
    'modificado',
    'id_usuario',
    'id_concepto_factura',
    'id_unidad',
    'mes',
    'anio',
    'fecha',
    'titular',
    'habilitado',
    'id_usuario_mod'];

    protected $guarded = ['id_recibo'];

    protected $primaryKey = 'id_recibo';

    public $timestamps = false;

    public $reglas = [
        'select_unidad' => 'required',
        'select_concepto' => 'required',
        'select_forma_pago' => 'required',
    ];
 
    public $mensajes = [
        'select_unidad.required' => 'Debe seleccionar la unidad',
        'select_concepto.required' => 'Debe seleccionar el concepto del pago',
        'select_forma_pago.required' => 'Debe seleccionar la forma de pago',
    ];

}
