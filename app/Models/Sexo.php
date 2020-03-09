<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    protected $table = 'sexos';
    protected $primaryKey = 'id_sexo'; //defecto incremental
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false; //si no existen los campos created_at  y updated_at se pone esto a false (si no existen en la BD)

    // relacion 1/N -->hasMeny un sexo tiene muchos actores(un mismo sexo puede estar en muchos actores)
    public function actores()
    {
        return $this->hasMany('App\Models\Actor','id_sexo'); // (lugar donde se encuentra, foreign key, como se llama el campo donde se va a guardar)
    }
}