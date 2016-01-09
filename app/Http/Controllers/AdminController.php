<?php

namespace App\Http\Controllers;

use App\Data\School;
use App\Register\RegisterHabits;
use Auth;
use Carbon\Carbon;
use Hash;
use Mail;
use App\Settings\Settings;
use App\Register\SelectList;
use App\Register\RegisterUsers;
use App\Register\RegisterDetails;
use App\Register\RegisterSubjects;
use App\Register\RegisterSubjects2;
use App\Register\SubjectList;
use Illuminate\Http\Request;
use App\Http\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /*
     *
     * General Controller Group
     *
     */

    public function General (){

        $user_data = RegisterUsers::where('email', Auth::user()->email)->get();

        $user_details = RegisterDetails::where('account_id', $user_data[0]->id)->get();

        $settings_value = Settings::all();

        $user_reg_subject_1 = RegisterSubjects::where('account_id', $user_data[0]->id)
            ->get();

        $user_reg_subject_1_displayName = SubjectList::where('subject_id', isset($user_reg_subject_1[0]) ? $user_reg_subject_1[0]->reg_subject_1 : 0)
            ->get();

        $user_reg_subject_2 = RegisterSubjects2::where('account_id', $user_data[0]->id)
            ->get();

        $user_reg_subject_2_displayName = SubjectList::where('subject_id', isset($user_reg_subject_2[0]) ? $user_reg_subject_2[0]->reg_subject_2 : 0)
            ->get();

        $user_school_displayName = School::select('country','school_name')->where('school_code', $user_details[0]->school)->get();

        if(!isset($user_reg_subject_1[0]) && !isset($user_reg_subject_2[0])){
            return redirect()->intended('/general/select-subject');
        }

        if($user_details[0]->phone == ''){
            return redirect()->intended('/general/update');
        }

        if($user_details[0]->tc_class == 0){
            return redirect()->intended('/general/update');
        }


        return view('general.index', compact('user_details', 'user_data', 'settings_value', 'user_reg_subject_1', 'user_reg_subject_2', 'user_reg_subject_1_displayName', 'user_reg_subject_2_displayName', 'user_school_displayName'));

    }

    public function UpdateView (){

        $school_country = School::groupBy('country')->get();

        $settings_value = Settings::all();

        $user_data = RegisterUsers::where('email', Auth::user()->email)->get();

        $user_details = RegisterDetails::where('account_id', $user_data[0]->id)->get();

        return view('general.update', compact('user_details', 'user_data', 'settings_value', 'school_country'));
    }

    public function Update (Requests\UpdateCheck $request) {

        $account_details = RegisterUsers::where('email', Auth::user()->email)->get();

        if($request->get('password') != ''){
            RegisterUsers::where('email', Auth::user()->email)
                ->update([
                    'password' => Hash::make($request->get('password'))
                ]);
        }
        RegisterUsers::where('email', Auth::user()->email)
            ->update([
                'type' => $request->get('type')
            ]);
        RegisterDetails::where('account_id', $account_details[0]->id)
            ->update([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'tc_class' => $request->get('tc_class'),
                'school' => $request->get('school')
            ]);

        return redirect()->intended('/general');
    }

    /*
     *
     * Console Controller Group
     *
     *
     */

    public function Console (){

        $subject_list_1 = SubjectList::where('subject_id', '<', 20000)->get();

        for($i = 0; $i < 9; $i ++){

            $subject_count_1[$subject_list_1[$i]->subject_id] = RegisterSubjects::where('reg_subject_1', $subject_list_1[$i]->subject_id)->count();

            $subject_count_1[$subject_list_1[$i]->subject_id] = RegisterSubjects::where('reg_subject_1', $subject_list_1[$i]->subject_id)->count();

        }

        $subject_list_2 = SubjectList::where('subject_id', '>', 20000)->get();

        for($i = 0; $i < 5; $i ++){

            $subject_count_2[$subject_list_2[$i]->subject_id] = RegisterSubjects2::where('reg_subject_2', $subject_list_2[$i]->subject_id)->count();

            $subject_count_2[$subject_list_2[$i]->subject_id] = RegisterSubjects2::where('reg_subject_2', $subject_list_2[$i]->subject_id)->count();

        }

        $meat_count = RegisterHabits::where('meat_veg', 1)->count();
        $veg_count = RegisterHabits::where('meat_veg', 0)->count();

        $total_count = RegisterUsers::where('type','<>','super')->count();

        $total_count_with_reg_complete = RegisterDetails::where('phone','!=','')->count()-1;

        $settings_value = Settings::all();

        return view('console.index', compact('settings_value', 'total_count_with_reg_complete', 'meat_count', 'veg_count', 'subject_list_1', 'subject_list_2', 'subject_count_1', 'subject_count_2', 'total_count'));

    }

    public function SystemConfigView (){

        $user_data = RegisterUsers::where('email', Auth::user()->email)->get();

        $settings_value = Settings::all();

        return view('console.system-config', compact('settings_value', 'user_data'));

    }

    public function SystemConfigUpdate (Requests\SystemConfigCheck $request){

        Settings::where('id', 1)->update(['value' => $request->get('start_reg')]);
        Settings::where('id', 2)->update(['value' => $request->get('end_reg')]);
        Settings::where('id', 3)->update(['value' => $request->get('start_survey')]);
        Settings::where('id', 4)->update(['value' => $request->get('end_survey')]);
        Settings::where('id', 5)->update(['value' => $request->get('final_out')]);

        return redirect()->intended('/console');

    }

    public function MemberQuery (){

        $user_details = RegisterDetails::with(['users', 'reg1', 'reg2', 'reg1.sList', 'reg2.sList', 'habits'])->where('phone' , '<>' , '')->orderby('id')->paginate(75);

        return view('console.member-query', compact('user_details'));

    }

    public function OldMemberQuery (){

        $reg_start = Settings::where('id', 1)->get();

        $user_details = RegisterUsers::where('reg_time' , '<' , $reg_start[0]->value)->get();

        return view('console.old-member-query', compact('user_details'));

    }

    public function SMSSend(Request $request){

        $verify_code = RegisterUsers::where('id',  $request->get('account_id'))->get();
        $phone = RegisterDetails::where('account_id', $request->get('account_id'))->get();

        $rand = $verify_code[0]->verify_code;

        /* Send the SMS to Users */
        $date = date("YmdHis");
        $pwd_file = fopen(public_path('msg_tmp/').$date.$rand.".txt","a");
        $content = "ccucc,".$phone[0]->phone.",夥伴您好：驗證碼：".$rand."請填入系統送出註冊並填報名資訊，始完成報名。驗證網站：https://goo.gl/kfvpCT,";
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

        $email = $verify_code[0]->email;
        $name = $phone[0]->name;

        /* Send the Mail to Users */

        Mail::send('emails.welcome', ['code' => $rand], function($message) use ($email, $name)
        {
            $message->from('k12cc@ccu.edu.tw', '105偏鄉教師寒假教學專業成長研習');
            $message->to($email, $name)->subject('【驗證通知信】105偏鄉教師寒假教學專業成長研習');
        });

        return redirect()->intended($request->url);

    }

    public function PWDSend(Request $request){

        $verify_code = RegisterUsers::where('id',  $request->get('account_id'))->get();
        $phone = RegisterDetails::where('account_id', $request->get('account_id'))->get();

        $rand = $verify_code[0]->verify_code;

        $email = $verify_code[0]->email;
        $name = $phone[0]->name;

        /* Send the SMS to Users */
        $date = date("YmdHis");
        $pwd_file = fopen(public_path('msg_tmp/').$date.$email.".txt","a");
        $content = "ccucc,".$phone[0]->phone.",105偏鄉教師研習系統通知；臨時密碼為：".$rand."，登入請至：https://cycwww.ccu.edu.tw/reset-verify,";
        $content = iconv('UTF-8','Big5',$content);
        fwrite($pwd_file, $content);
        fclose($pwd_file);
        $chk_file = fopen(public_path('msg_tmp/').$date.$email.".chk","a");
        fclose($chk_file);

        $conn_id = ftp_connect("210.71.253.195");
        $login_result = ftp_login($conn_id, "sms", "sms");
        if ($login_result){
            ftp_put($conn_id,$date.$email.".txt",public_path('msg_tmp/').$date.$email.".txt", FTP_ASCII);
            ftp_put($conn_id,$date.$email.".chk",public_path('msg_tmp/').$date.$email.".chk", FTP_ASCII);
        }

        /* Send the Mail to Users */

        Mail::send('emails.forget', ['code' => $rand], function($message) use ($email, $name)
        {
            $message->from('k12cc@ccu.edu.tw', '105偏鄉教師寒假教學專業成長研習');
            $message->to($email, $name)->subject('【臨時密碼通知信】105偏鄉教師寒假教學專業成長研習');
        });

        return redirect()->intended($request->url);

    }

    public function PriorityMemberQuery(){

        $select_count = SelectList::all()->count();
        $select_list = SelectList::all();
        $count = 0;
        for($i = 0; $i < $select_count; $i++){
            if(isset($select_list[0]->pid)){
                $count += RegisterUsers::where('pid', $select_list[0]->pid)->take(1)->count();
            }elseif(isset($select_list[0]->email)){
                $count += RegisterUsers::where('email', $select_list[0]->email)->take(1)->count();
            }elseif(isset($select_list[0]->phone)){
                $count += RegisterDetails::where('phone', $select_list[0]->phone)->take(1)->count();
            }elseif(isset($select_list[0]->phone)){
                $count += RegisterDetails::where('name', $select_list[0]->name)->take(1)->count();
            }
        }




    }
}
