<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    protected $table = 'tutoriales';
    protected $primaryKey = 'id';
    //public $incrementing = false;
    protected $fillable = ['id','titulo','descripcion','html','palabras_clave','created_ad','updated_at','sub_id'];
    //public $timestamps = false;
}
