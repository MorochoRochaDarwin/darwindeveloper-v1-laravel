<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Tutorial;
use App\SubCategoria;

class AdminTutoriales extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');//forzamos a que los usuarios que deseen ver estas paginas deben estar logrados
        $this->middleware('typeuser:super');//para que solo el administrador pueda usar estas urls
    }


    public function tutoriales($id)
    {
        $sub = SubCategoria::where('id', $id)->get();
        $sub = $sub[0];
        return view('admin.subcategoria', ['subcategoria' => $sub]);
    }

    public function getTutoriales($sub_id)
    {
        $tutoriales = Tutorial::where('sub_id', $sub_id)->orderBy('updated_at', 'desc')->get();
        $json = array();
        $response = array();
        foreach ($tutoriales as $tut) {
            $url_edit = url('/admin/edit-tutorial/' . $tut->id);
            $json[] = array($tut->titulo, $tut->created_at->toDateTimeString(), $tut->updated_at->toDateTimeString(),
                "<a href='{$url_edit}' class='btn btn-primary'><i class='fa fa-pencil'></i></a>
<button class='btn btn-danger' onclick='eliminar({$tut->id})'><i class='fa fa-trash'></i></button>"
            );
        }
        $response['data'] = $json;

        return json_encode($response);

    }

    public function nuevoTutorial(Request $request)
    {
        try {
            $scat = $request->input('subcat');
            $titulo = $request->input('titulo');
            $descripcion = $request->input('descripcion');
            $html = $request->input('html');
            $pc = $request->input('pc');
            Tutorial::create([
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'html' => $html,
                'palabras_clave' => $pc,
                'sub_id' => $scat
            ]);

            return "exito";
        } catch (QueryException $e) {
            //$error_code = $e->errorInfo[1];
            //if($error_code == 1062){}

            return $e->getMessage();
        }
    }

    public function eliminar(Request $request)
    {
        try {
            $id = $request->input('id');
            Tutorial::where('id', $id)->delete();
            return "exito";
        } catch (QueryException $e) {
            //$error_code = $e->errorInfo[1];
            //if($error_code == 1062){}

            return $e->getMessage();
        }
    }


    public function getEdit($id)
    {
        $tutorial = Tutorial::where('id', $id)->first();
        return view('admin.edittutorial', ['tutorial' => $tutorial]);
    }


    public function edit(Request $request)
    {
        try {
            $id = $request->input('id');
            $titulo = $request->input('titulo');
            $descripcion = $request->input('descripcion');
            $html = $request->input('html');
            $pc = $request->input('pc');
            $tutorial = Tutorial::where('id', $id)->first();
            $tutorial->titulo = $titulo;
            $tutorial->descripcion = $descripcion;
            $tutorial->html = $html;
            $tutorial->palabras_clave = $pc;

            $tutorial->save();

            return "exito";
        } catch (QueryException $e) {
            //$error_code = $e->errorInfo[1];
            //if($error_code == 1062){}

            return $e->getMessage();
        }
    }
}
