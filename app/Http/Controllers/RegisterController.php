<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request; ## NOTE: if use this, the Request::all(); will not work

use App\Register\RegisterSubjects;
use App\User\UserDetails;
use Hash;
use App\Http\Requests;
use App\Register\RegisterUsers;
use App\Register\RegisterDetails;
use App\Register\Verify;
use Request;
use Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

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

        return view('general.select-subject');

    }

    public function selectSubjectUpdate(Requests\SelectSubjectCheck $request){

        $account_details = RegisterUsers::where('email', Auth::user()->email)->get();

        $input = new RegisterSubjects();

        $input->account_id = $account_details[0]->id; // 'Cause the variable account_id is a array.
        $input->reg_subject_1 = $request->get('reg_subject_1');
        $input->already_pick_1 = 0;
        $input->reg_subject_2 = $request->get('reg_subject_2');
        $input->already_pick_2 = 0;
        $input->ps = 'NORMAL';
        $input->priority = 0;
        $input->save();

        return redirect()->intended('/general');

    }
}
