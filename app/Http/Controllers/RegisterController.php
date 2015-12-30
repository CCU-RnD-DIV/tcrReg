<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request; ## NOTE: if use this, the Request::all(); will not work

use Hash;
use App\Http\Requests;
use App\Register\RegisterUsers;
use App\Register\RegisterDetails;
use Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function regPrimary (){

        return view('register.register', ['type' => 'primary']);


    }

    public function regJunior (){

        return view('register.register', ['type' => 'junior']);


    }

    public function storePrimary (Requests\AddRegister $request){


        $input = new RegisterUsers();

        $input->email = $request->get('email');
        $input->password = Hash::make($request->get('password'));
        $input->pid = $request->get('pid');
        $input->type = 'primary';
        $input->reg_verify = 0;
        $input->reg_time = Carbon::now();
        $input->save();

        $input = new RegisterDetails();

        $input->name = $request->get('name');
        $input->gender = $request->get('gender');
        $input->school = $request->get('school');
        $input->phone = $request->get('phone');
        $input->save();

        //return $input;
        //Register::create($input);

        return redirect('register/success');


    }

    public function storeJunior (Requests\AddRegister $request){

        $input = new RegisterUsers();

        $input->email = $request->get('email');
        $input->password = Hash::make($request->get('password'));
        $input->pid = $request->get('pid');
        $input->type = 'junior';
        $input->reg_verify = 0;
        $input->reg_time = Carbon::now();
        $input->save();

        $input = new RegisterDetails();

        $input->name = $request->get('name');
        $input->gender = $request->get('gender');
        $input->school = $request->get('school');
        $input->phone = $request->get('phone');
        $input->save();

        //return $input;
        //Register::create($input);

        return redirect('register/success');

    }
}
