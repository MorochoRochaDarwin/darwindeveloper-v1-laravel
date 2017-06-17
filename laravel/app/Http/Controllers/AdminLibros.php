<?php

namespace App\Http\Controllers;

use App\Libro;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class AdminLibros extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');//forzamos a que los usuarios que deseen ver estas paginas deben estar logrados
        $this->middleware('typeuser:super');//para que solo el administrador pueda usar estas urls
    }


    public function getAddEditRemoveColumnData($categoria)
    {


        $entrada = DB::table('libros')->select(['id', 'titulo', 'created_at', 'updated_at', 'categoria'])
            ->where('categoria', $categoria);


        return Datatables::of($entrada)
            ->addColumn('action', function ($entrada) {
                $url_edit = url('admin/libros/' . urlencode($entrada->categoria) . '/edit/' . $entrada->id);
                $url = url('libros/' . urlencode($entrada->categoria) . '/' . urlencode($entrada->titulo));
                return "<a target='_blank' class='btn btn-xs btn-info' href='{$url}'><i class='fa fa-eye'></i> Ver</a> <a href='{$url_edit}' class='btn btn-xs btn-success'><i class='fa fa-pencil'></i> Editar</a> <button onclick='delete_item($entrada->id)' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> Eliminar</button>";
            })
            ->editColumn('id', '{{$id}}')
            ->removeColumn('categoria')
            ->make(true);
    }


    public function nuevoLibro($categoria, Request $request)
    {

        try {

            $img64 = $request->input('img64');

            if (isset($img64)) {
                list($type, $data) = explode(';', $img64);
                list(, $data) = explode(',', $data);

                $data = base64_decode($data);
                $filename = md5(uniqid(rand(), true)) . '.png';
                $path = '/uploads/' . $filename;

                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $filename, $data);


                DB::table('libros')->insert(
                    [
                        'titulo' => $request->input('titulo'),
                        'contenido' => $request->input('html'),
                        'portada' => $path,
                        'categoria' => $request->input('categoria'),
                        "created_at" => \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
                return "exito";
            } else {
                return "ERROR: imagen no valida";
            }


        } catch (QueryException $e) {
            return $e->getMessage();
        }

    }


    public function  eliminarLibro(Request $request)
    {
        try {
            $id = $request->input('id');
            $cat = Libro::where('id', $id)
                ->first();

            $path = $cat->portada;


            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $path);

            }
            $cat->delete();


            return "exito";
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }


    public function edit($categoria, $libro)
    {
        $libro = Libro::where('id', $libro)->first();
        return view('admin.editlibro', ['libro' => $libro]);


    }


    public function saveEdit(Request $request)
    {

        try {

            $img64 = $request->input('img64');

            if (!is_null($img64)) {

                $id = $request->input('id');
                $cat = Libro::where('id', $id)
                    ->first();
                $path = $cat->portada;
                //elimina la imagen actual y la reemplazamos con la nueva
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $path);
                }

//guardamos la imagen
                list($type, $data) = explode(';', $img64);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $filename = md5(uniqid(rand(), true)) . '.png';
                $path = '/uploads/' . $filename;
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $filename, $data);


                $cat->titulo = $request->input('titulo');
                $cat->contenido = $request->input('html');
                $cat->portada = $path;
                $cat->save();


                return "exito";
            } else {
                $id = $request->input('id');
                $cat = Libro::where('id', $id)
                    ->first();

                $cat->titulo = $request->input('titulo');
                $cat->contenido = $request->input('html');
                $cat->save();
                return "exito";
            }


        } catch (QueryException $e) {
            return $e->getMessage();
        }

    }

}
