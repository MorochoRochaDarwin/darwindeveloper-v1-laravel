<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table = 'entradas_curso';
    protected $primaryKey = 'id';
    protected $fillable = ['id','titulo','descripcion','created_at','update_at','capitulo','html','palabras_clave'];
}
