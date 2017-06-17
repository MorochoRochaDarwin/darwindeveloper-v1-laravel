<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Categoria;
use App\Http\Requests;

class CategoriaController extends Controller
{

    public function getAll()
    {
        $categorias = Categoria::all();
        return view('categorias', ['categorias' => $categorias]);
    }
}
