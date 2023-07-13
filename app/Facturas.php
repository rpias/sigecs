<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    // Hace referencia al nombre de la tabla en la DB
    protected $table = 'facturas';

    // Los campos declarados aqui son impresindibles
    // llenar para crear un registro
    protected $fillable = [
        'fecha_emitido',
        'fecha_vencimiento',
        'fecha_limite',
        'id_concepto',
        'importe',
        'importe_interes',
        'importe_interes_fecha_calculo',
        'importe_total',
        'id_recibo_cancelada',
        'hija_de',
        'id_unidad',
        'id_usuario'
    ];

    // Los campos declarados aqui nunca se pasan
    // para crear un registro
    protected $guarded = ['id_factura', 'creado', 'modificado'];

    // Si la Clave Primaria de una Tabla
    // no se llama 'id' hay que declararla
    // obligatoriamente AQUI
    protected $primaryKey = 'id_factura';

    // Esta declaracion hace que no se
    // agregen a las consultas de
    // INSERT y UPDATE los campos
    // created_at y update_at
    public $timestamps = false;
}
