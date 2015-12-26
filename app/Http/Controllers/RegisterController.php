<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RegisterController extends Controller {

    public function regPrimary (){

        return view('register.register', ['type' => 'primary']);


    }

    public function regJunior (){

        return view('register.register', ['type' => 'junior']);


    }

}