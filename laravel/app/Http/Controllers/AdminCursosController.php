<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Curso;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class AdminCursosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');//forzamos a que los usuarios que deseen ver estas paginas deben estar logrados
        $this->middleware('typeuser:super');//para que solo el administrador pueda usar estas urls
    }


    public function cursos()
    {

        $categorias = Categoria::all();

        return view('admin.cursos', ["categorias" => $categorias]);

    }


    public function nuevocurso(Request $request)
    {

        try {
            $ncurso = $request->input('ncurso');
            $categoria = $request->input('cat');
            //insertamos la categoria en la base de datos
            Curso::create([
                'id' => $ncurso,
                'categoria' => $categoria
            ]);
            return back()->with('status', "Curso \"$ncurso\" Creado");
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }
    }


    public function getcursos()
    {
        $cursos = Curso::orderBy('updated_at', 'DESC')->get();
        $json = array();
        $response = array();
        foreach ($cursos as $curso) {
            $url=url("admin/cursos/".urlencode(strtolower($curso->id)));
            $json[] = array("<a href='$url'>$curso->id</a>", $curso->categoria, $curso->created_at->toDateTimeString(), $curso->updated_at->toDateTimeString(),
                "<button class='btn btn-danger' title='eliminar curso' onclick=\"delete_item('{$curso->id}')\"><i class='fa fa-trash'></i></button>"
            );
        }
        $response['data'] = $json;

        return json_encode($response);

    }


    public function  deletecurso(Request $request)
    {
        try {
            $id = $request->input('id');
            Curso::where('id', $id)
                ->delete();
            return "exito";
        } catch (QueryException $e) {
            return $e->getMessage();
        }

    }

}
