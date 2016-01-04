<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use App\Http\Requests;
use App\Register\RegisterUsers;
use App\Register\RegisterDetails;
use App\Http\Controllers\Controller;

class ToolController extends Controller
{
    public function setBcrypt(){

        ini_set('max_execution_time', 3000);

        $user_data = RegisterUsers::all();

        for($i = 0 ; $i < 1510 ; $i ++) {

            $hashing = Hash::make($user_data[$i]->password);

            RegisterUsers::where('reg_verify', 1)->where('id', $user_data[$i]->id)->update(['password' => $hashing, 'reg_verify' => '3']);


        }

        return 'SUCCESS';
    }
}
