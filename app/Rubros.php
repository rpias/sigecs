<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubros extends Model
{
    protected $table = 'contable_rubros';

    protected $fillable = ['id_rubro'];

    protected $guarded = ['id_rubro'];

    protected $primaryKey = 'id_rubro';

    public $timestamps = false;
}
