<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $table = 'peliculas';
    protected $primaryKey = 'id_pelicula';
    public $incrementing = true; //porque el dni no es incremental
    protected $keyType = 'int';

    public $timestamps = false;

    // N/M una pelicula puede tener muchos temas
    public function temas()//tambla donde vamos
    {
        return $this->belongsToMany('App\Models\Tema','temas_pel','id_pelicula','id_tema'); // (tabla relacionada,la tabla que se a creado a partir de las dos ,id de una tabla,id de la otra(los campos que hay en la tabla creada en la BD))
    }
}