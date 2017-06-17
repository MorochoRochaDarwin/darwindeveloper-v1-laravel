<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Capitulo;
use App\Curso;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AdminCapitulosController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');//forzamos a que los usuarios que deseen ver estas paginas deben estar logrados
        $this->middleware('typeuser:super');//para que solo el administrador pueda usar estas urls
    }

    public function capitulos($curso_id)
    {
        $curso = Curso::where('id', urldecode($curso_id))->first();

        return view('admin.capitulos', ["curso" => $curso]);

    }


    public function getAddEditRemoveColumnData($curso_id)
    {
        $capitulo = DB::table('capitulos_curso')
            ->select(['id', 'nombre', 'curso', 'created_at', 'updated_at'])->where('curso', urldecode($curso_id));


        return Datatables::of($capitulo)
            ->addColumn('action', function ($capitulo) {
                return '<button onclick="edit_item(\''.$capitulo->nombre.'\',' . $capitulo->id . ')" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</button>' . ' <button onclick="delete_item(' . $capitulo->id . ')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Eliminar</button>';
            })
            ->editColumn('id', '{{$id}}')
            ->editColumn('nombre', '<a href="'.url('admin/cursos').'/{{$curso}}/{{$id}}">{{$nombre}}</a>')
            ->make(true);
    }


    public function nuevocapitulo(Request $request)
    {
        try {
            $titulo = $request->input('titulo');
            $curso = $request->input('curso');
            Capitulo::create(['nombre' => $titulo, 'curso' => $curso]);

            return back()->with('status', "capitulo \"$titulo\" creado");
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }
    }


    public function  deletecapitulo(Request $request)
    {
        try {
            $id = $request->input('id');
            Capitulo::where('id', $id)
                ->delete();
            return "exito";
        } catch (QueryException $e) {
            return $e->getMessage();
        }

    }

    public function  editcapitulo(Request $request)
    {
        try {
            $id = $request->input('id');
            $cap = Capitulo::where('id', $id)
                ->first();

            $cap->nombre = $request->input('titulo');
            $cap->save();
            return back()->with('status', "capitulo Actualizado");
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }

    }

}
