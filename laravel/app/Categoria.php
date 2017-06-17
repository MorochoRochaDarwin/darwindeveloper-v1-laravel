<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id','img','webs'];
    //public $timestamps = false;
}
