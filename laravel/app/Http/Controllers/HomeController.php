<?php

namespace App\Http\Controllers;

use App\Capitulo;
use App\Categoria;
use App\Curso;
use App\Libro;
use App\SubCategoria;
use App\Tutorial;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }


    public function cursos()
    {

        $cursos = DB::table('users_cursos')->where('user_id', Auth::user()->id)->get();

        $no_cursos = DB::table('cursos')
            ->whereNotIn('cursos.id', function ($query) {
                $query->select(DB::raw('curso'))->distinct()
                    ->from('users_cursos')
                    ->whereRaw('users_cursos.user_id = ' . Auth::user()->id);
            })
            ->join('categorias as c', 'c.id', '=', 'cursos.categoria')->select('cursos.*', 'c.img')
            ->get();

        //el Query anterior es equivalente a
        /*
         * select * from cursos where id not in (select curso from users_curso where user_id<>id_user)
         * con un join extra
         */


        $json = $this->createJSON($cursos);
        return view('admin.users.cursos', [
            'cursos' => \GuzzleHttp\json_decode($json),
            'mas_cursos' => $no_cursos
        ]);
    }


    function createJSON($cursos)
    {
        $json = array();


        foreach ($cursos as $curso) {

            $capitulos = DB::table('capitulos_curso')
                ->where('curso', $curso->curso)
                ->get();


            $tmp_cap = array();
            foreach ($capitulos as $capitulo) {
                $tmp_en = array();
                $entradas = DB::table('entradas_curso')
                    ->where('capitulo', $capitulo->id)
                    ->select('id', 'titulo')->get();

                foreach ($entradas as $entrada) {
                    $tmp = array();
                    $tmp['id'] = $entrada->id;
                    $tmp['titulo'] = $entrada->titulo;
                    $res = DB::table('users_entradas_cursos')->where('entrada', $entrada->id)
                        ->where('user_id', Auth::user()->id)
                        ->first();
                    if ($res) {//si el usuario tiene asignado a su lista este curso
                        $tmp['vista'] = 1;
                    } else {
                        $tmp['vista'] = 0;
                    }

                    $tmp_en[] = $tmp;
                }

                $tmp_cap[] = array('id' => $capitulo->id, 'nombre' => $capitulo->nombre, 'entradas' => $tmp_en);

            }
            $json[] = array('curso' => $curso->curso, 'capitulos' => $tmp_cap);

        }

        return json_encode($json);
    }


    public function tutoriales()
    {

        $json = array();
        $categorias = Categoria::all();

        foreach ($categorias as $categoria) {


            $sub_categorias = SubCategoria::where('categoria', $categoria->id)->get();
            $tmp_subcategorias = array();
            foreach ($sub_categorias as $sub) {

                $tutoriales = Tutorial::where('sub_id', $sub->id)->get();
                $tmp_tutoriales = array();
                foreach ($tutoriales as $tutorial) {
                    $res = DB::table('users_tutoriales')->where('tutorial', $tutorial->id)
                        ->where('user_id', Auth::user()->id)
                        ->first();
                    $vista = 0;
                    if ($res) {//si el usuario tiene asignado a su lista este curso
                        $vista = 1;
                    }

                    $tmp_tutoriales[] = array('id' => $tutorial->id,
                        'titulo' => $tutorial->titulo,
                        'vista' => $vista);

                }


                $tmp_subcategorias[] = array('id' => $sub->id,
                    'nombre' => $sub->nombre,
                    'tutoriales' => $tmp_tutoriales);


            }

            $json[] = array('categoria' => $categoria->id,
                'sub_categorias' => $tmp_subcategorias);


        }

        return view('admin.users.tutoriales', [
            'json' => \GuzzleHttp\json_decode(json_encode($json))
        ]);
    }


    public function libros()
    {
        $categorias = Categoria::all();
        $json = array();
        foreach ($categorias as $categoria) {
            $libros = Libro::where('categoria', $categoria->id)->select('id', 'titulo', 'portada')->get();
            $json[] = array('categoria' => $categoria->id, 'libros' => $libros);

        }

        $json = json_encode($json);

        return view('admin.users.libros', ['json' => \GuzzleHttp\json_decode($json)]);
    }


    public function tipocuenta()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('admin.users.user', ['user' => $user]);
    }


    public function password(Request $request)
    {
        try {
            $pass1 = $request->input('password');
            $pass2 = $request->input('password_confirmation');


            if ($pass1 == $pass2) {
                $email = $request->input('email');
                $user = User::where('id', Auth::user()->id)
                    ->where('email', $email)
                    ->first();

                if ($user) {

                    if ($user->facebook_id == null && $user->google_id == null && $user->github_id == null && $user->twitter_id == null){
                        if (password_verify($request->input('apassword'), $user->password)) {

                            $user->password = password_hash($pass1, PASSWORD_DEFAULT);
                            $user->save();
                        } else {
                            return back()->with('passwordf', 'Tu contraseña actual NO coincide con nuestros registros');
                        }
                    }else{
                        return back()->with('passwordf', 'Usted no puede establecer una contraseña ya que se registro por medio de una red social o similar');
                    }


                } else {
                    return back()->with('passwordf', 'No se encontro el usuario');
                }

            } else {
                return back()->with('passwordf', 'las contraseñas no coinciden');
            }

            return back()->with('password', 'contraseña cambiada');

        } catch (QueryException $e) {
            return back()->with('passwordf', $e->getMessage());
        }

    }

}
