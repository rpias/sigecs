<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConceptoFactura extends Model
{
    protected $table = 'conceptos_facturas';

     // Los campos declarados aqui son impresindibles
    // llenar para crear un registro
    protected $fillable = ['nombre', 'se_muestra'];

    // Los campos declarados aqui nunca se pasan
    // para crear un registro
    protected $guarded = ['id_concepto_factura'];

    // Si la Clave Primaria de una Tabla
    // no se llama 'id' hay que declararla
    // obligatoriamente AQUI
    protected $primaryKey = 'id_concepto_factura';

    // Esta declaracion hace que no se
    // agregen a las consultas de
    // INSERT y UPDATE los campos
    // created_at y update_at
    public $timestamps = false;

}
