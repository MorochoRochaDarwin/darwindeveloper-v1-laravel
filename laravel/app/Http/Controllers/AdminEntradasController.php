<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Entrada;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Capitulo;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class AdminEntradasController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');//forzamos a que los usuarios que deseen ver estas paginas deben estar logrados
        $this->middleware('typeuser:super');//para que solo el administrador pueda usar estas urls
    }

    public function entradas($curso_id, $capitulo_id)
    {
        $capitulo = Capitulo::where('id', $capitulo_id)
            ->first();

        return view('admin.entradas', ["capitulo" => $capitulo]);

    }


    public function nuevaEntrada($curso_id, $capitulo_id)
    {
        $capitulo = Capitulo::where('id', $capitulo_id)
            ->first();

        return view('admin.nuevaentrada', ["capitulo" => $capitulo]);

    }

    public function editEntrada($curso_id, $capitulo_id, $entrada_id)
    {
        $capitulo = Capitulo::where('id', $capitulo_id)
            ->first();
        $entrada = Entrada::where('id', $entrada_id)->first();


        return view('admin.editentrada', ["capitulo" => $capitulo, 'entrada' => $entrada]);
    }


    public function deleteEntrada($curso_id, $capitulo_id, Request $request)
    {
        try {
            Entrada::where('id', $request->input('id'))
                ->delete();
            return "exito";
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }


    public function SaveNuevaEntrada($curso_id, $capitulo_id, Request $request)
    {
        try {

            Entrada::create([
                'titulo' => $request->input('titulo'),
                'descripcion' => $request->input('descripcion'),
                'palabras_clave' => $request->input('pc'),
                'html' => $request->input('html'),
                'capitulo' => $capitulo_id
            ]);

            return "exito";
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }


    public function SaveEditEntrada($curso_id, $capitulo_id, $entrada_id, Request $request)
    {
        try {

            $entrada = Entrada::where('id', $request->input('entrada_id'))->first();
            $entrada->titulo = $request->input('titulo');
            $entrada->descripcion = $request->input('descripcion');
            $entrada->html = $request->input('html');
            $entrada->palabras_clave = $request->input('pc');

            $entrada->save();

            return "exito";
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }

    public function getAddEditRemoveColumnData($curso_id, $capitulo_id)
    {


        $entrada = Entrada::select(['id', 'titulo', 'capitulo', 'created_at', 'updated_at'])
            ->where('capitulo', $capitulo_id);


        return Datatables::of($entrada)
            ->addColumn('action', function ($entrada) {

                return "<button onclick='url_open($entrada->id)' class='btn btn-xs btn-info'><i class='fa fa-pencil'></i> Editar</button><button onclick='delete_item($entrada->id)' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> Eliminar</button>";
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);
    }


}
