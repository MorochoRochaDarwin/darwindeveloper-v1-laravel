<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Categoria;
use App\SubCategoria;
use ErrorException;


class AdminCategoriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');//forzamos a que los usuarios que deseen ver estas paginas deben estar logrados
        $this->middleware('typeuser:super');//para que solo el administrador pueda usar estas urls
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View vista categorias
     */
    public function categorias()
    {
        // $categorias = Categoria::all();

        return view('admin.categorias');

    }


    public function webs($id)
    {
        $cat = Categoria::where('id', urldecode($id))->first();
        return view('admin.webs', ['categoria' => $cat]);
    }

    public function savewebs(Request $request, $id)
    {
        try {
            $cat = Categoria::where('id', $request->input('categoria'))->first();
            $cat->webs = $request->input('html');
            $cat->save();

            return "exito";
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View vista con las categorias que seran usadas por las subcategorias
     */
    public function subcategorias()
    {
        $categorias = Categoria::all();

        return view('admin.subcategorias', ["categorias" => $categorias]);

    }

    /**
     * @return string json con las categorias para el datatable
     */
    public function getcategorias()
    {
        $categorias = Categoria::orderBy('updated_at', 'DESC')->get();
        $json = array();
        $response = array();
        foreach ($categorias as $cat) {
            $url_libros = url('admin/libros/' . urlencode($cat->id));
            $url_webs = url('admin/webs/' . urlencode($cat->id));
            $json[] = array($cat->id, $cat->created_at->toDateTimeString(), $cat->updated_at->toDateTimeString(),
                "
<a class='btn btn-success'  href='{$url_webs}'><i class='fa fa-globe'></i></a>
<a class='btn btn-primary'  href='{$url_libros}'><i class='fa fa-book'></i></a>
<button class='btn btn-info' title='editar categoria' onclick=\"edit_item('{$cat->id}')\"><i class='fa fa-pencil'></i></button>
<button class='btn btn-danger' title='eliminar categoria' onclick=\"delete_item('{$cat->id}')\"><i class='fa fa-trash'></i></button>"
            );
        }
        $response['data'] = $json;

        return json_encode($response);

    }

    /**
     * @return string json con las subcategorias para el datatable
     */
    public function getsubcategorias()
    {

        $categorias = SubCategoria::all();
        $json = array();
        $response = array();
        foreach ($categorias as $cat) {
            $urls = url('/admin/tutoriales/' . $cat->id);
            $json[] = array($cat->id, "<a href='{$urls}'>$cat->nombre</a>", $cat->categoria, $cat->created_at->toDateTimeString(), $cat->updated_at->toDateTimeString(),
                "<button class='btn btn-danger' onclick=\"delete_items('{$cat->id}')\"><i class='fa fa-trash'></i></button>"
            );
        }
        $response['data'] = $json;

        return json_encode($response);

    }


    public function newcategoria(Request $request)
    {
        $ncat = $request->input('ncat');

        $ext = $request->file('img')->getClientOriginalExtension();
        $imageName = md5(uniqid(rand(), true)) . '.' . $ext;
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        $request->file('img')->move($path, $imageName);
        Categoria::create(['id' => $ncat, 'img' => '/uploads/' . $imageName]);//insertamos la categoria en la base de datos
        return redirect('/admin/categorias');
    }


    public function  editcategoria(Request $request)
    {
        try {
            $id = $request->input('id');
            $cat = Categoria::where('id', $id)
                ->first();

            $path = $cat->img;

            $file = $request->file('img');
            if (isset($file)) {
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $path);
                }

                $ext = $file->getClientOriginalExtension();
                $imageName = md5(uniqid(rand(), true)) . '.' . $ext;
                $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
                $request->file('img')->move($path, $imageName);
                $cat->img = '/uploads/' . $imageName;
            }

            $cat->save();
            return redirect('/admin/categorias');

        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }


    public function newsubcategoria(Request $request)
    {
        try {
            $ncat = $request->input('ncat');
            $cat = $request->input('cat');
            SubCategoria::create(['nombre' => $ncat, 'categoria' => $cat]);//insertamos la categoria en la base de datos
            return "exito";
        } catch (QueryException $e) {
            //$error_code = $e->errorInfo[1];
            //if($error_code == 1062){}

            return $e->getMessage();
        }
    }


    /**
     * ellmina una categoria
     * @param Request $request datos enviados via ajax
     * @return string mensaje de exito o error
     */
    public function  deletecategoria(Request $request)
    {
        try {
            $id = $request->input('id');
            $cat = Categoria::where('id', $id)
                ->first();

            $path = $cat->img;


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

    /**
     * elimina un archivo
     * @param $paths
     * @return bool
     */
    public function delete($paths)
    {
        $paths = is_array($paths) ? $paths : func_get_args();

        $success = true;

        foreach ($paths as $path) {
            try {
                if (!@unlink($path)) {
                    $success = false;
                }
            } catch (ErrorException $e) {
                $success = false;
            }
        }

        return $success;
    }

    /**
     * ellmina una subcategoria
     * @param Request $request datos enviados via ajax
     * @return string mensaje de exito o error
     */
    public function  deletesubcategoria(Request $request)
    {
        try {
            $id = $request->input('id');
            SubCategoria::where('id', $id)
                ->delete();
            return "exito";
        } catch (QueryException $e) {
            return $e->getMessage();
        }

    }


    public function subcategoria($id)
    {


        $sub = SubCategoria::where('id', $id)->get();
        $sub = $sub[0];
        return view('admin.subcategoria', ['subcategoria' => $sub]);

    }


}
