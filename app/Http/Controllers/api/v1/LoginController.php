<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //Funcion login que almacenara una variable que obtiene el email y login y con eso intentar el login
    public function index(Request $request){
        $login = $request-> validate([
            'email'=> 'required|string',
            'password'=>'required|string'
        ]);

        if(!Auth::attempt($login)){
            return response(['message' => 'Invalid Login Credentials']);
        }

        try{
            $user = Auth::user();
            $accesToken = $user->createToken('authToken')->accesToken;
            return response(['user' => Auth::user(), 'access_token' => $accesToken]);

        }catch(Exception $ex){
            
            return response(['message'=>$ex->getMessage()]);
        }
        
    }
}