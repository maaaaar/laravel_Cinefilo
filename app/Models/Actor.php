<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $table = 'actores';
    protected $primaryKey = 'dni';
    public $incrementing = false; //porque el dni no es incremental
    protected $keyType = 'string';

    public $timestamps = false;

    // N/1 un actor solo puede tener un sexo
    public function sexo()
    {
        return $this->belongsTo('App\Models\Sexo', 'id_sexo'); //la tabla que esta relacionada y el campo donde se va a guardar
    }

}