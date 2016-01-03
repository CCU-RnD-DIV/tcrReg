<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request; ## NOTE: if use this, the Request::all(); will not work

use Auth;
use Hash;
use Mail;
use Request;
use Carbon\Carbon;

use App\Data\School;
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

    public function register (){

        $school_country = School::groupBy('country')->get();

        return view('register.register', compact('school_country'));


    }

    public function privacy (){

        return view('register.privacy');


    }

    public function store (Requests\RegisterCheck $request){

        $input = new RegisterUsers();
        $input->email = $request->get('email');
        $input->password = Hash::make($request->get('password'));
        $input->pid = $request->get('pid');
        $input->type = $request->get('type');;
        $input->verify_code = $rand = substr(md5(sha1( $request->get('email').$request->get('password'))),0,6);
        $input->reg_verify = 0;
        $input->reg_time = Carbon::now();
        $input->save();

        $account_details = RegisterUsers::select('id')->where('email', $request->get('email'))->get();

        $input = new RegisterDetails();

        $input->account_id = $account_details[0]->id; // 'Cause the variable account_id is a array.
        $input->name = $request->get('name');
        $input->gender = $request->get('gender');
        $input->school = $request->get('school');
        $input->phone = $request->get('phone');
        $input->save();

        /* Send the SMS to Users */
        $date = date("YmdHis");
        $pwd_file = fopen(public_path('msg_tmp/').$date.$rand.".txt","a");
        $content = "ccucc,".$request->get('phone').",".$request->get('name')."夥伴您好：請將驗證碼填入偏鄉教師研習系統送出，始完成註冊。並填報名資訊，始完成報名。本次驗證碼為：".$rand."願初春時分邀請您蒞臨！驗證網站為：https://cycwww.ccu.edu.tw/verify 中正師培,";
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

        $email = $request->get('email');
        $name = $request->get('name');

        /* Send the Mail to Users */

        Mail::send('emails.welcome', ['code' => $rand], function($message) use ($email, $name)
        {
            $message->from('k12cc@ccu.edu.tw', '105偏鄉教師寒假教學專業成長研習');
            $message->to($email, $name)->subject('【驗證通知信】105偏鄉教師寒假教學專業成長研習');
        });

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
            $input->reg_time = Carbon::Now();
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
            $input->reg_time = Carbon::Now();
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

        if ($habit_exist == 1){

            RegisterHabits::where('account_id', $account_details[0]->id)
                ->update(['meat_veg' => $request->get('meat_veg')]);

        }else if($habit_exist == 0){

            $input = new RegisterHabits();

            $input->account_id = $account_details[0]->id; // 'Cause the variable account_id is a array.
            $input->meat_veg = $request->get('meat_veg');
            $input->save();

        }


        return redirect()->intended('/general');

    }

    public function selectTraffic (){

        $account_details = RegisterUsers::where('email', Auth::user()->email)->get();

        $user_habits = RegisterHabits::where('account_id', $account_details[0]->id)->get();

        if(isset($user_habits[0])){
            $convert_traffic_displayName = ($user_habits[0]->traffic) ? '是' : '否' ; /* traffic  = 1 : Yes ; = 0 : No */

            if($user_habits[0]->traffic == 3){
                $convert_traffic_displayName = '是，需於【台鐵嘉義站後站】搭乘接駁車';
            }elseif($user_habits[0]->traffic == 2){
                $convert_traffic_displayName = '是，需於【嘉義高鐵站二號出口處】搭乘接駁車';
            }elseif($user_habits[0]->traffic == 1){
                $convert_traffic_displayName = '否，我將自行開車前往中正大學';
            }elseif($user_habits[0]->traffic == 0){
                $convert_traffic_displayName = '否，我會自行抵達中正大學';
            }

        }else{
            $convert_traffic_displayName = '尚未選擇';
        }


        return view('general.select-traffic', compact('user_habits', 'user_data', 'convert_traffic_displayName'));

    }

    public function selectTrafficUpdate(Requests\TrafficCheck $request){

        $account_details = RegisterUsers::where('email', Auth::user()->email)->get();

        $habit_exist = RegisterHabits::where('account_id', $account_details[0]->id)->count();

        if ($habit_exist == 1){

            RegisterHabits::where('account_id', $account_details[0]->id)
                ->update(['traffic' => $request->get('traffic')]);

        }else if($habit_exist == 0){

            $input = new RegisterHabits();

            $input->account_id = $account_details[0]->id; // 'Cause the variable account_id is a array.
            $input->traffic = $request->get('traffic');
            $input->save();

        }


        return redirect()->intended('/general');

    }
}
