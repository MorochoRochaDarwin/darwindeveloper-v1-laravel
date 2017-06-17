<?php

namespace App\Http\Controllers;

use App\Capitulo;
use App\Categoria;
use App\Entrada;
use App\Libro;
use App\Mail\Contactos;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Tutorial;
use Illuminate\Support\Facades\Mail;


class DefaultController extends Controller
{

    public function index()
    {
        $tutoriales = DB::table('tutoriales as t')
            ->join('sub_categorias as s', 't.sub_id', '=', 's.id')
            ->join('categorias as c', 'c.id', '=', 's.categoria')->select('t.*', 's.categoria', 'c.img')
            ->orderBy('updated_at', 'DESC')
            ->limit(30)
            ->paginate(6);




        $cursos = DB::table('cursos as cu')
            ->join('categorias as c', 'c.id', '=', 'cu.categoria')->select('cu.*', 'c.img')
            ->orderBy('updated_at', 'DESC')->limit(6)->get();
        return view('welcome', ['tutoriales' => $tutoriales, 'cursos' => $cursos]);
    }


    public function tutoriales()
    {
        $sub = DB::table('sub_categorias')
            ->get();

        return view('tutoriales', ['subcategorias' => $sub,]);
    }


    public function getTutoriales(Request $request)
    {
        $tutoriales = DB::table('tutoriales as t')->where('t.sub_id', $request->input('subid'))->get();


        echo "<div class=\"list-group\">";
        foreach ($tutoriales as $tut) {
            $url = url('/tutorial/' . $tut->id . '/' . urlencode(strtolower($tut->titulo)));
            echo "<a href='{$url}'  class='list-group-item'>{$tut->titulo}</a>";
        }
        echo "</div>";


    }


    public function tutorial($id)
    {  //el siguiente query es equivalente al SQL
        //select t.*,s.nombre as subcategoria from tutoriales as t inner join sub_categorias as s on t.sub_id = s.id where t.id = 1
        $tutorial = DB::table('tutoriales as t')
            ->join('sub_categorias as s', function ($join) {
                $join->on('t.sub_id', '=', 's.id');
            })->select('t.*', 's.nombre as subcategoria')->where('t.id', $id)->first();

        $tutoriales = DB::table('tutoriales as t')->where('t.sub_id', '=', $tutorial->sub_id)->get();


        $visto = false;
        if (!Auth::guest()) {
            $check = DB::table('users_tutoriales')
                ->where('tutorial', $id)
                ->where('user_id', Auth::user()->id)
                ->first();

            if ($check) {
                $visto = true;
            }
        }


        return view('tutorial', [
            'tutorial' => $tutorial,
            'tutoriales' => $tutoriales,
            'visto' => $visto
        ]);

    }


    public function guardarTutorial(Request $request)
    {
        $id = $request->input('tutorial_id');
        if (!Auth::guest()) {
            try {
                DB::table('users_tutoriales')->insert([
                    'user_id' => Auth::user()->id,
                    'tutorial' => $id
                ]);

                return "exito";
            } catch (QueryException $e) {
                return $e->getMessage();
            }

        } else {
            return "usuario no logeado";
        }

    }


    public function cursos()
    {
        $cursos = DB::table('cursos as cu')
            ->join('categorias as c', 'c.id', '=', 'cu.categoria')->select('cu.*', 'c.img')
            ->orderBy('updated_at', 'DESC')
            ->paginate(8);

        return view('cursos', ['cursos' => $cursos,]);
    }


    public function getCurso($curso_id)
    {
        $cursoid = urldecode($curso_id);//decodificamos el parametro GET
        //recuperamos el curso
        $curso = DB::table('cursos as cu')->where('cu.id', $cursoid)
            ->join('categorias as c', 'c.id', '=', 'cu.categoria')
            ->select('cu.*', 'c.img')->first();

        //recuperamos los capitulos del curso
        $capitulos = Capitulo::where('curso', $cursoid)->get();

        //recuperamos las entradas del curso
        $entradas = DB::table('entradas_curso as e')
            ->join('capitulos_curso as cc', 'cc.id', '=', 'e.capitulo')
            ->where('cc.curso', $cursoid)
            ->select('e.*')->get();


        $user_curso = false;//sera true si el suaurio logeado tiene asignado este curso a su lista de favoritos

        //comprueba si un usuario esta logeado
        if (!Auth::guest()) {
            $res = DB::table('users_cursos')->where('curso', $cursoid)
                ->where('user_id', Auth::user()->id)
                ->first();
            if ($res) {//si el usuario tiene asignado a su lista este curso
                $user_curso = true;
            }


        }

        $json = $this->createJSONentradas($entradas, $user_curso);

        //devolvemos los datos ndecesarios
        return view('curso', [
            'curso' => $curso,
            'capitulos' => $capitulos,
            'user_curso' => $user_curso,
            'json_entradas' => \GuzzleHttp\json_decode($json)
        ]);
    }

    public function getEntrada($curso_id, $capitulo_id, $entrada_id, $titulo_entrada)
    {
        $cursoid = urldecode($curso_id);
        $curso = DB::table('cursos as cu')->where('cu.id', $cursoid)
            ->join('categorias as c', 'c.id', '=', 'cu.categoria')
            ->select('cu.*', 'c.img')->first();

        $capitulos = Capitulo::where('curso', $cursoid)->get();

        $entradas = DB::table('entradas_curso as e')
            ->join('capitulos_curso as cc', 'cc.id', '=', 'e.capitulo')
            ->where('cc.curso', $cursoid)
            ->select('e.*')->get();

        $entrada = Entrada::where('id', $entrada_id)->first();

        $user_curso = false;

        if (!Auth::guest()) {
            $res = DB::table('users_cursos')->where('curso', $cursoid)
                ->where('user_id', Auth::user()->id)
                ->first();
            if ($res) {
                $user_curso = true;
            }
        }

        $capitulo = Capitulo::where('id', $capitulo_id)->first();

        $json = $this->createJSONentradas($entradas, $user_curso);

        //la vista entrada extiende de curso
        return view('entrada', [
            'curso' => $curso,
            'capitulos' => $capitulos,
            'entrada' => $entrada,
            'user_curso' => $user_curso,
            'capitulo' => $capitulo,
            'json_entradas' => \GuzzleHttp\json_decode($json)
        ]);
    }


    public function guardarCurso(Request $request)
    {
        try {
            if (!Auth::guest()) {
                $curso = $request->input('curso_id');
                DB::table('users_cursos')->insert(
                    ['user_id' => Auth::user()->id, 'curso' => $curso]
                );
            }
            return "exito";
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }


    public function guardarEntrada(Request $request)
    {
        try {
            if (!Auth::guest()) {
                $cursoid = $request->input('curso_id');
                $res = DB::table('users_cursos')->where('curso', $cursoid)
                    ->where('user_id', Auth::user()->id)
                    ->first();
                if ($res) {//si el usuario tiene asignado a su lista este curso
                    $entrada = $request->input('entrada_id');
                    DB::table('users_entradas_cursos')->insert(
                        ['user_id' => Auth::user()->id, 'entrada' => $entrada]
                    );
                } else {
                    return "Tiene que guardar este curso en su lista para realizar esta accion";
                }
            } else {
                return "usuario no logeado";
            }
            return "exito";
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }


    /**
     * crea un json del array query Entradas obtenido , ademas une un campo extra que almacena 1 si la entrada ha sido vista por el usuario
     * @param $entradas
     * @param $user_curso
     * @return string json resultante
     */
    private function createJSONentradas($entradas, $user_curso)
    {
        $json = array();
        $tmp = array();
        foreach ($entradas as $entrada) {
            $tmp['id'] = $entrada->id;
            $tmp['titulo'] = $entrada->titulo;
            $tmp['capitulo'] = $entrada->capitulo;
            if ($user_curso) {
                $res = DB::table('users_entradas_cursos')->where('entrada', $entrada->id)
                    ->where('user_id', Auth::user()->id)
                    ->first();
                if ($res) {//si el usuario tiene asignado a su lista este curso
                    $tmp['vista'] = 1;
                } else {
                    $tmp['vista'] = 0;
                }
            } else {
                $tmp['vista'] = 0;
            }

            $json[] = $tmp;
        }

        return json_encode($json);

    }


    public function libros($categoria)
    {
        $libros = Libro::where('categoria', urldecode($categoria))->get();
        return view('libroscategoria', ['libros' => $libros, 'categoria' => $categoria]);
    }


    public function contactos(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $sms = $request->input('sms');


        Mail::to('dsmr.apps@gmail.com')->send(new Contactos($email, $name, $subject, $sms));

        return back()->with('sms enviado', 'Mensaje Enviado');

    }


    public function  webs($lenguaje)
    {
        $cat = Categoria::where('id', urldecode($lenguaje))->first();

        if($cat){
            return view('webs',['webs'=>$cat->webs,'lenguaje'=>$lenguaje]);
        }else{
            return abort(404);
        }

    }


}
