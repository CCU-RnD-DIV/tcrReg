<?php

namespace App\Http\Controllers;

use App\User\UserDetails;
use App\Register\RegisterUsers;
use App\Register\RegisterDetails;
use Auth;
use Hash;
use Mail;
use Cache;
use App\Http\Requests;
use App\Http\User;
use Carbon\Carbon;
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

        $loginFailed = true;

        return view('auth.generalLogin', compact('loginFailed'));

    }

    public function CheckConsoleLogin (Requests\ConsoleLoginCheck $request){

        if (Auth::attempt(['email' => $request->get('account'), 'password' => $request->get('password')])){

            return redirect()->intended('/console');
        }

        $loginFailed = true;

        return view('auth.consoleLogin', compact('loginFailed'));

    }

    public function reset (){

        return view('auth.reset');

    }

    public function resetVerifyView (){

        return view('auth.resetVerify');

    }

    public function resetGenerate (Requests\ResetCheck $request){



        $user_data = RegisterUsers::where('email', $request->get('email'))
            ->where('pid', $request->get('pid'))
            ->get();

        $rand = substr(md5(sha1(rand(100000,999999))),0,6);

        if (isset($user_data[0])){

            RegisterUsers::where('email', $request->get('email'))
                ->where('pid', $request->get('pid'))
                ->update(['verify_code' => $rand , 'reg_verify' => 2]);


        }else{
            return view('auth.reset')->with('alert_failed', true);
        }


        $user_details = RegisterDetails::where('account_id', $user_data[0]->id)->get();

        /* Send the SMS to Users */
        $date = date("YmdHis");
        $pwd_file = fopen(public_path('msg_tmp/').$date.$user_data[0]->email.".txt","a");
        $content = "ccucc,".$user_details[0]->phone.",105偏鄉教師研習系統通知；臨時密碼為：".$rand."，登入請至：https://cycwww.ccu.edu.tw/reset-verify,";
        $content = iconv('UTF-8','Big5',$content);
        fwrite($pwd_file, $content);
        fclose($pwd_file);
        $chk_file = fopen(public_path('msg_tmp/').$date.$user_data[0]->email.".chk","a");
        fclose($chk_file);

        $conn_id = ftp_connect("210.71.253.195");
        $login_result = ftp_login($conn_id, "sms", "sms");
        if ($login_result){
            ftp_put($conn_id,$date.$user_data[0]->email.".txt",public_path('msg_tmp/').$date.$user_data[0]->email.".txt", FTP_ASCII);
            ftp_put($conn_id,$date.$user_data[0]->email.".chk",public_path('msg_tmp/').$date.$user_data[0]->email.".chk", FTP_ASCII);
        }

        $email = $request->get('email');
        $name = $request->get('name');

        /* Send the Mail to Users */

        Mail::send('emails.forget', ['code' => $rand], function($message) use ($email, $name)
        {
            $message->from('k12cc@ccu.edu.tw', '105偏鄉教師寒假教學專業成長研習');
            $message->to($email, $name)->subject('【臨時密碼通知信】105偏鄉教師寒假教學專業成長研習');
        });

        return redirect('reset-verify')->with('alert_failed', true);
    }

    public function resetVerify (Requests\Verify $request){

        if (RegisterUsers::where('verify_code', $request->get('verify'))->where('reg_verify', 2)->count()){

            $account_details = RegisterUsers::where('verify_code', $request->get('verify'))->get();

            RegisterUsers::where('verify_code', $request->get('verify'))
                ->where('reg_verify', 2)
                ->update(['reg_verify' => 1]);

            if (Auth::loginUsingId( $account_details[0]->id )){

                return redirect('/general/update');
            }

        }else{ /* The Verify Code Not Found */

            return view('auth.resetVerify')->with('alert_failed', true);

        }



    }

    public function logout(){
        Auth::logout();
        return redirect()->intended('/');
    }

}