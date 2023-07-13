<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condominio extends Model
{
    protected $table = 'condominios';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'direccion', 'telefono',
    ];

    

}


