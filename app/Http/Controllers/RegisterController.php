<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request; ## NOTE: if use this, the Request::all(); will not work

use Auth;
use Hash;
use Request;
use Carbon\Carbon;

use App\Register\SubjectList;
use App\Register\RegisterUsers;
use App\Register\RegisterDetails;
use App\Register\RegisterHabits;
use App\Register\RegisterSubjects;
use App\Register\RegisterSubjects2;
use App\User\UserDetails;
use App\Http\Requests;
use App\Register\Verify;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{

    public function reg (){

        return view('register.register');


    }

    public function store (Requests\RegisterCheck $request){

        $input = new RegisterUsers();
        $input->email = $request->get('email');
        $input->password = Hash::make($request->get('password'));
        $input->pid = $request->get('pid');
        $input->type = 'primary';
        $input->verify_code = $rand = substr(md5(sha1( $request->get('email').$request->get('password'))),0,6);
        $input->reg_verify = 0;
        $input->reg_time = Carbon::now();
        $input->save();

        $account_details = RegisterUsers::select('id')->where('email', $request->get('email'))->get();

        $input = new RegisterDetails();

        $input->account_id = $account_details[0]->id; // 'Cause the variable account_id is a array.
        $input->name = $request->get('name');
        $input->gender = $request->get('gender');
        $input->school = 1;
        $input->phone = $request->get('phone');
        $input->save();

        /* Send the SMS to Users */
        $date = date("YmdHis");
        $pwd_file = fopen(public_path('msg_tmp/').$date.$rand.".txt","a");
        $content = "ccucc,".$request->get('phone').",105偏鄉教師研習登入帳號：".$request->get('email')."；您的啟用碼：".$rand.",";
        $content = iconv('UTF-8','Big5',$content);
        fwrite($pwd_file, $content);
        fclose($pwd_file);
        $chk_file = fopen(public_path('msg_tmp/').$date.$rand.".chk","a");
        fclose($chk_file);

        $conn_id = ftp_connect("210.71.253.195");
        $login_result = ftp_login($conn_id, "sms", "sms");
        if ($login_result){
            ftp_put($conn_id,$date.$rand.".txt",public_path('msg_tmp/').$date.$rand.".txt", FTP_ASCII);
            ftp_put($conn_id,$date.$rand.".chk",public_path('msg_tmp/').$date.$rand.".chk", FTP_ASCII);
        }

        return redirect('verify');


    }

    public function verify (){

        return view('register.verify');

    }

    public function verifyCheck (Requests\Verify $request){

        if (RegisterUsers::where('verify_code', $request->get('verify'))->count()){

            $account_details = RegisterUsers::where('verify_code', $request->get('verify'))->get();

            RegisterUsers::where('verify_code', $request->get('verify'))
                ->where('reg_verify', 0)
                ->update(['reg_verify' => 1]);

            if (Auth::loginUsingId( $account_details[0]->id )){

                return redirect()->intended('/general/select-subject');
            }

        }else{ /* The Verify Code Not Found */

            return view('register.verify')->with('alert_failed', true);

        }



    }

    public function selectSubject (){

        $user_data = RegisterUsers::where('email', Auth::user()->email)->get();

        $user_details = RegisterDetails::where('account_id', $user_data[0]->id)->get();

        $user_reg_subject_1 = RegisterSubjects::where('account_id', $user_data[0]->id)
            ->get();

        $user_reg_subject_1_displayName = SubjectList::where('subject_id', isset($user_reg_subject_1[0]) ? $user_reg_subject_1[0]->reg_subject_1 : 0)
            ->get();

        $user_reg_subject_2 = RegisterSubjects2::where('account_id', $user_data[0]->id)
            ->get();

        $user_reg_subject_2_displayName = SubjectList::where('subject_id', isset($user_reg_subject_2[0]) ? $user_reg_subject_2[0]->reg_subject_2 : 0)
            ->get();

        return view('general.select-subject', compact('user_details', 'user_data', 'user_reg_subject_1', 'user_reg_subject_2', 'user_reg_subject_1_displayName', 'user_reg_subject_2_displayName'));

    }

    public function selectSubjectUpdate(Requests\SelectSubjectCheck $request){

        $account_details = RegisterUsers::where('email', Auth::user()->email)->get();

        $first_day_data_exist = RegisterSubjects::where('account_id', $account_details[0]->id)->count();

        $second_day_data_exist = RegisterSubjects2::where('account_id', $account_details[0]->id)->count();

        /* If User Doesn't Select the Subject, the Data Would Not Be Saved */
        /* If User Has Filled the Form Before, We Will Update the Previous Data */
        /* First Day Registration Data */



        if ($first_day_data_exist == 1){

            if($request->get('reg_subject_1') != 0){
                RegisterSubjects::where('account_id', $account_details[0]->id)->update(['reg_subject_1' => $request->get('reg_subject_1')]);
            }else{
                RegisterSubjects::where('account_id', $account_details[0]->id)->delete();
            }


        }else if($first_day_data_exist == 0 && $request->get('reg_subject_1')){

            $input = new RegisterSubjects();

            $input->account_id = $account_details[0]->id; // 'Cause the variable account_id is a array.
            $input->reg_subject_1 = $request->get('reg_subject_1');
            $input->already_pick_1 = 0;
            $input->ps = 'NORMAL';
            $input->priority = 0;
            $input->save();

        }



        /* If User Doesn't Select the Subject, the Data Would Not Be Saved */
        /* If User Has Filled the Form Before, We Will Update the Previous Data */
        /* Second Day Registration Data */



        if ($second_day_data_exist == 1){

            if($request->get('reg_subject_2') != 0){
                RegisterSubjects2::where('account_id', $account_details[0]->id)->update(['reg_subject_2' => $request->get('reg_subject_2')]);
            }else{
                RegisterSubjects2::where('account_id', $account_details[0]->id)->delete();
            }

        }else if($second_day_data_exist == 0 && $request->get('reg_subject_2')){

            $input = new RegisterSubjects2();

            $input->account_id = $account_details[0]->id; // 'Cause the variable account_id is a array.
            $input->reg_subject_2 = $request->get('reg_subject_2');
            $input->already_pick_2 = 0;
            $input->ps = 'NORMAL';
            $input->priority = 0;
            $input->save();

        }

        $user_habits_exist = RegisterHabits::where('account_id', $account_details[0]->id)->count();

        if($user_habits_exist){
            return redirect()->intended('/general');
        }else{
            return redirect()->intended('/general/select-habits');
        }


    }

    public function selectHabits (){

        $account_details = RegisterUsers::where('email', Auth::user()->email)->get();

        $user_habits = RegisterHabits::where('account_id', $account_details[0]->id)->get();

        if(isset($user_habits[0])){
            $convert_meat_veg_displayName = ($user_habits[0]->meat_veg) ? '葷食' : '素食' ; /* meat_veg = 1 : Meat ; = 0 : Veg */
        }else{
            $convert_meat_veg_displayName = '尚未選擇';
        }


        return view('general.select-habits', compact('user_habits', 'user_data', 'convert_meat_veg_displayName'));

    }

    public function selectHabitsUpdate(Requests\HabitCheck $request){

        $account_details = RegisterUsers::where('email', Auth::user()->email)->get();

        $habit_exist = RegisterHabits::where('account_id', $account_details[0]->id)->count();

        /* If User Doesn't Select the Subject, the Data Would Not Be Saved */
        /* If User Has Filled the Form Before, We Will Update the Previous Data */
        /* First Day Registration Data */



        if ($habit_exist == 1){

            RegisterHabits::where('account_id', $account_details[0]->id)->update(['meat_veg' => $request->get('meat_veg')]);

        }else if($habit_exist == 0){

            $input = new RegisterHabits();

            $input->account_id = $account_details[0]->id; // 'Cause the variable account_id is a array.
            $input->meat_veg = $request->get('meat_veg');
            $input->save();

        }


        return redirect()->intended('/general');

    }
}
