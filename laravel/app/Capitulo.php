<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    //
    protected $table = 'capitulos_curso';
    protected $primaryKey = 'id';
    protected $fillable = ['id','nombre','created_at','update_at','curso'];
}
