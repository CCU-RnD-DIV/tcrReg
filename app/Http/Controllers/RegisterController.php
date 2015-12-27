<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request; ## NOTE: if use this, the Request::all(); will not work

use App\Http\Requests;
use App\Register\RegisterUsers;
use App\Register\RegisterDetails;
use Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function regPrimary (){

        return view('register.register', ['type' => 'Primary']);


    }

    public function regJunior (){

        return view('register.register', ['type' => 'Junior']);


    }

    public function storePrimary (){


        $input = new RegisterUsers();

        $input->email = Request::get('email');
        $input->pwd = Request::get('pwd');
        $input->pid = Request::get('pid');
        $input->type = 'junior';
        $input->reg_verify = 0;
        $input->reg_time = Carbon::now();
        $input->save();

        $input = new RegisterDetails();

        $input->name = Request::get('name');
        $input->gender = Request::get('gender');
        $input->school = Request::get('school');
        $input->phone = Request::get('phone');
        $input->save();

        //return $input;
        //Register::create($input);

        return redirect('register/success');


    }

    public function storeJunior (){

        $input = new RegisterUsers();

        $input->email = Request::get('email');
        $input->pwd = Request::get('pwd');
        $input->pid = Request::get('pid');
        $input->type = 'junior';
        $input->reg_verify = 0;
        $input->reg_time = Carbon::now();
        $input->save();

        $input = new RegisterDetails();

        $input->name = Request::get('name');
        $input->gender = Request::get('gender');
        $input->school = Request::get('school');
        $input->phone = Request::get('phone');
        $input->save();

        //return $input;
        //Register::create($input);

        return redirect('register/success');

    }
}
