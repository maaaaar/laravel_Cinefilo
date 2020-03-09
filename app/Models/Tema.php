<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $table = 'temas';
    protected $primaryKey = 'id_tema';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    // N/M un tema puede estar en muchas peliculas
    public function peliculas()
    {
        return $this->belongToMany('App\Models\Pelicula','temas_pel','id_tema', 'id_pelicula'); // (tabla relacionada,la tabla que se a creado a partir de las dos ,id de una tabla,id de la otra(los campos que hay en la tabla creada en la BD))
    }
}