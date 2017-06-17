<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //
    protected $table = 'libros';
    protected $primaryKey = 'id';
    //public $incrementing = false;
    protected $fillable = ['id','titulo','contenido','created_ad','updated_at','categoria'];
}
