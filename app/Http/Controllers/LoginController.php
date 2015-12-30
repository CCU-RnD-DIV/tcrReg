<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\Http\Requests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LoginController extends Controller {

    public function generalLogin (){

        return view('auth.generalLogin');


    }

    public function consoleLogin (){

        return view('auth.consoleLogin');


    }

    public function CheckGeneralLogin (Requests\LoginCheck $request){

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])){
            return redirect()->intended('/general');
        }
        return view('auth.generalLogin');

    }

    public function CheckConsoleLogin (Requests\LoginCheck $request){

        return view('auth.consoleLogin');

    }

    public function logout(){
        Auth::logout();
        return redirect()->intended('/');
    }

}