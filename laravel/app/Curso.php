<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id','created_at','update_at','categoria'];
    //public $timestamps = false;
}
