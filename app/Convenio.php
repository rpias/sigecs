<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    // Hace referencia al nombre de la tabla en la DB
    protected $table = 'convenios';

    // Los campos declarados aqui son impresindibles
    // llenar para crear un registro
    protected $fillable = [
        'id_convenio',
        'id_unidad',
        'fecha',
        'recargo',
        'import_adelanto',
        'importe_total',
        'cantidad_cuotas',
        'importe_cuota',
        'obs',
        'creado',
        'modificado',
        'id_usuario',
        'activo',
        'id_persona',
        'refinanciado',
        'importe_refinanciado',
        'cantidad_cuotas_refinanciado',
        'titular',
        'estado_convenio',
        'cedula_titular'
    ];

    // Los campos declarados aqui nunca se pasan
    // para crear un registro
    protected $guarded = ['id_convenio'];

    // Si la Clave Primaria de una Tabla
    // no se llama 'id' hay que declararla
    // obligatoriamente AQUI
    protected $primaryKey = 'id_convenio';
}
