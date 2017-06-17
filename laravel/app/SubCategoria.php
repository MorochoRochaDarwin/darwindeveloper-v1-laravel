<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    protected $table = 'sub_categorias';
    protected $primaryKey = 'id';
    //public $incrementing = false;
    protected $fillable = ['id','nombre','categoria'];
    //public $timestamps = false;
}
