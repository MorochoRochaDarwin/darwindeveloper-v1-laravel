<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DefaultController@index');

Auth::routes();

//urls de la vista general (no administracion)
Route::get('/home', 'HomeController@index');
Route::get('/contactos', function () {
    return view('contactos');
});


Route::post('/contactos', 'DefaultController@contactos');

Route::get('guia', function () {
    $categorias = \App\Categoria::all();
    return view('allguia', ['categorias' => $categorias]);
});

Route::get('guia/{lenguaje}', function ($lenguaje) {
    return view('guia',['lenguaje'=>$lenguaje]);
});

Route::get('webs/{lenguaje}', 'DefaultController@webs');

Route::get('/informacion', function () {
    return view('informacion');
});
Route::get('/tutoriales', 'DefaultController@tutoriales');
Route::post('/tutoriales', 'DefaultController@getTutoriales');
Route::get('/tutorial/{id}/{titulo}', 'DefaultController@tutorial');

Route::post('/guardar-curso', 'DefaultController@guardarCurso');
Route::post('/guardar-entrada', 'DefaultController@guardarEntrada');

Route::post('/guardar-tutorial', 'DefaultController@guardarTutorial');

Route::get('/cursos', 'DefaultController@cursos');
Route::get('/cursos/{curso_id}', 'DefaultController@getCurso');
Route::get('/cursos/{curso_id}/{capitulo_id}/{entrada_id}/{titulo_entrada}', 'DefaultController@getEntrada');

Route::get('libros', function () {
    $categorias = \App\Categoria::all();
    return view('libros', ['categorias' => $categorias]);
});

Route::get('libros/{categoria}', 'DefaultController@libros');


Route::get('log-out', function(){
    return view('logout');
});



Route::get('libros/{categoria}/{libro}', function ($categoria, $libro) {
    $libro = \App\Libro::where('categoria', urldecode($categoria))->where('titulo', urldecode($libro))->first();

    if ($libro) {
        return view('libro', ['categoria' => urldecode($categoria), 'libro' => $libro]);
    } else {
        return abort(404);
    }

});






//adminstracion
Route::group(['prefix' => 'admin'], function () {
    Route::post('getcategorias', 'AdminCategoriasController@getcategorias');
    Route::post('getsubcategorias', 'AdminCategoriasController@getsubcategorias');
    Route::get('categorias', 'AdminCategoriasController@categorias');
    Route::get('subcategorias', 'AdminCategoriasController@subcategorias');
    Route::post('categorias', 'AdminCategoriasController@newcategoria');
    Route::post('newsubcategoria', 'AdminCategoriasController@newsubcategoria');
    Route::post('categorias/delete-categoria', 'AdminCategoriasController@deletecategoria');
    Route::post('subcategorias/delete-sub-categoria', 'AdminCategoriasController@deletesubcategoria');
    Route::post('tutoriales/{sub_id}', 'AdminTutoriales@getTutoriales');
    Route::post('eliminar-tutorial', 'AdminTutoriales@eliminar');
    Route::post('eliminar-usuario', 'AdminUsuarios@eliminar');
    Route::post('edit-categoria', 'AdminCategoriasController@editcategoria');
    Route::post('edit-tutorial', 'AdminTutoriales@edit');
    Route::get('edit-tutorial/{id}', 'AdminTutoriales@getEdit');
    Route::get('tutoriales/{sub_id}', 'AdminTutoriales@tutoriales');
    Route::get('nuevo-tutorial/{cat}/{sub_id}', function ($cat, $sub_id) {
        return view('admin.newtutorial', ['cat' => $cat, 'sub_id' => $sub_id]);
    });
    Route::get('usuarios', function () {
        return view('admin.usuarios');
    });
    Route::post('usuarios', 'AdminUsuarios@getUsuarios');
    Route::post('nuevo-tutorial', 'AdminTutoriales@nuevoTutorial');

    //cursos
    Route::get('cursos', 'AdminCursosController@cursos');
    Route::post('cursos/eliminar-curso', 'AdminCursosController@deletecurso');
    Route::post('nuevo-curso', 'AdminCursosController@nuevocurso');
    Route::post('getcursos', 'AdminCursosController@getcursos');

    //capitulos
    Route::get('cursos/{curso_id}', 'AdminCapitulosController@capitulos');
    Route::get('cursos/{curso_id}/getdata', 'AdminCapitulosController@getAddEditRemoveColumnData');
    Route::post('cursos/nuevo-capitulo', 'AdminCapitulosController@nuevocapitulo');
    Route::post('cursos/eliminar-capitulo', 'AdminCapitulosController@deletecapitulo');

    Route::post('cursos/edit-capitulo', 'AdminCapitulosController@editcapitulo');
//entradas de un capitulo
    Route::get('cursos/{curso_id}/{capitulo_id}', 'AdminEntradasController@entradas');
    Route::get('cursos/{curso_id}/{capitulo_id}/getdata', 'AdminEntradasController@getAddEditRemoveColumnData');
    Route::get('cursos/{curso_id}/{capitulo_id}/nueva-entrada', 'AdminEntradasController@nuevaEntrada');
    Route::post('cursos/{curso_id}/{capitulo_id}/nueva-entrada', 'AdminEntradasController@saveNuevaEntrada');
    Route::post('cursos/{curso_id}/{capitulo_id}/delete-entrada', 'AdminEntradasController@deleteEntrada');
    Route::get('cursos/{curso_id}/{capitulo_id}/edit-entrada/{entrada_id}', 'AdminEntradasController@editEntrada');
    Route::post('cursos/{curso_id}/{capitulo_id}/edit-entrada/{entrada_id}', 'AdminEntradasController@saveEditEntrada');


    Route::get('libros/{categoria}', function ($categoria) {
        return view('admin.libros', ['categoria' => $categoria]);
    });

    Route::get('libros/{categoria}/get', 'AdminLibros@getAddEditRemoveColumnData');


    Route::get('webs/{id}', 'AdminCategoriasController@webs');
    Route::post('webs/{id}', 'AdminCategoriasController@savewebs');
    Route::get('libros/{categoria}/nuevo-libro', function ($categoria) {
        return view('admin.nuevolibro', ['categoria' => urldecode($categoria)]);
    });


    Route::post('libros/{categoria}/nuevo-libro', 'AdminLibros@nuevoLibro');
    Route::get('libros/{categoria}/edit/{libro}', 'AdminLibros@edit');

    Route::post('eliminar-libro', 'AdminLibros@eliminarLibro');
    Route::post('edit-libro', 'AdminLibros@saveEdit');
});

//confirmacion de registro
Route::get('register/confirm/{userid}/{token}', 'LoginController@verify_token');

Route::get("test-email", function () {

    Mail::send("emails.bienvenido", [], function ($message) {
        $message->to("dsmr.apps@gmail.com", "Darwin Morocho")
            ->subject("Bienvenido a Darwin Developer!");
    });
});


//login urls
Route::get('/login/{social}', 'LoginController@redirectToProvider');
Route::get('/login/callback/{social}', 'LoginController@handleProviderCallback');

Route::post('loginfacebook', 'Auth\LoginController@loginfacebook');

//mailchimp
Route::post('nuevo-suscriptor', 'NewsletterManagerController@addEmailToList');


//admin usuarios
Route::group(['prefix' => 'home'], function () {
    Route::get('cursos', 'HomeController@cursos');
    Route::get('tutoriales', 'HomeController@tutoriales');
    Route::get('libros', 'HomeController@libros');
    Route::get('tu-cuenta', 'HomeController@tipocuenta');
    Route::get('password/reset', function () {
        return view('admin.users.reset');
    });

    Route::post('password/reset', 'HomeController@password');
});