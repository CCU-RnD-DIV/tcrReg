<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use App\Http\Requests;
use App\Settings\Settings;
use App\Register\SelectList;
use App\Register\RegisterUsers;
use App\Register\RegisterDetails;
use App\Register\RegisterSubjects;
use App\Register\RegisterSubjects2;
use App\Register\SubjectList;
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

    public function setPriority(){

        $first_day = SelectList::where('subject', '<', 20000)->get();
        $second_day = SelectList::where('subject', '>', 20000)->get();

        foreach ($first_day as $first_day_people){
            $user_name = RegisterDetails::where('phone', $first_day_people->phone)->get(['account_id']);
            if(isset($user_name[0])){
                if(isset($user_name[0]->account_id)){
                    RegisterSubjects::where('account_id', $user_name[0]->account_id)->update(['priority' => '1']);
                }
            }
        }

        foreach ($second_day as $second_day_people){
            $user_name = RegisterDetails::where('phone', $second_day_people->phone)->get(['account_id']);
            if(isset($user_name[0])){
                if(isset($user_name[0]->account_id)){
                    RegisterSubjects2::where('account_id', $user_name[0]->account_id)->update(['priority' => '1']);
                }
            }
        }

        return 'SUCCESS';


    }
}
