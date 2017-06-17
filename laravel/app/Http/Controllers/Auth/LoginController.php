<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }



    public function loginfacebook(Request $request){


       try{
           $email=$request->input('email');
           $user= User::where('facebook_id',$request->input('facebook_id'))->first();
           if(!$user){
               $user = User::create([
                   'name' => $request->input('username'),
                   'email' => $email,
                   'facebook_id' =>$request->input('facebook_id'),
               ]);

           }
           auth()->login($user);

           return "exito";
       }catch (QueryException $e){
           return $e->getMessage();
       }

    }
}
