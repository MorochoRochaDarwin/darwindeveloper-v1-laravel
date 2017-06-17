<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Database\QueryException;
use Socialite;


class LoginController extends Controller
{
    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($social)
    {

        return Socialite::driver('' . $social)->redirect();
    }


    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleProviderCallback($social)
    {
        try {
            $socialuser = Socialite::driver('' . $social)->user();

            //$user->token;
            //$user->getNickname();
            //$user->getName();
            //$user->getEmail();
            //$user->getAvatar();
        } catch (\Exception $e) {
            return $e->getMessage();
        }


        try {
            $user = User::where($social . '_id', $socialuser->getId())->first();
            if (!$user) {//si el usuario no existe
                $user = User::create([
                    'name' => $socialuser->getName(),
                    'email' => $socialuser->getEmail(),
                    $social . '_id' => $socialuser->getId(),
                ]);
            }
            auth()->login($user);
            return redirect()->to('/home');
        } catch (QueryException $e) {
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                return "error este email ya se encuentra registrado";
            }else{
                return $e->getMessage();
            }


        }


    }




    public function verify_token($userid,$token){
        $user=User::where('id',$userid)
            ->where('verify_token',$token)->first();
        if($user){
            $user->verify_token=null;
            $user->save();
            return redirect()->to('login');
        }else{
            return "usuario no encontrado";
        }
    }




}
