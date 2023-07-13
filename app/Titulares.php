<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulares extends Model
{
    protected $table = 'titulares';

    protected $fillable = ['id_persona', 'id_usuario', 'activo'];

    protected $guarded = ['id_titular'];

    protected $primaryKey = 'id_titular';

    public $timestamps = false;

}
