<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminUsuarios extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');//forzamos a que los usuarios que deseen ver estas paginas deben estar logrados
        $this->middleware('typeuser:super');//para que solo el administrador pueda usar estas urls
    }



    public function getUsuarios()
    {
        $usuarios = User::all();
        $json = array();
        $response = array();
        foreach ($usuarios as $u) {

            $json[] = array($u->name,$u->email, $u->created_at->toDateTimeString(), $u->updated_at->toDateTimeString(),
                "<button class='btn btn-danger' onclick='eliminar({$u->id})'><i class='fa fa-trash'></i></button>"
            );
        }
        $response['data'] = $json;

        return json_encode($response);

    }



    public function eliminar(Request $request)
    {
        try {
            $id = $request->input('id');
            User::where([
                ['type','<>','super'],
                ['id', $id]
            ])->delete();
            return "exito";
        } catch (QueryException $e) {
            //$error_code = $e->errorInfo[1];
            //if($error_code == 1062){}

            return $e->getMessage();
        }
    }
}
