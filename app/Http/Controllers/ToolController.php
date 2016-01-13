<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Mail;
use App\Http\Requests;
use App\Settings\Settings;
use App\Register\SelectList;
use App\Data\School;
use App\Data\FarSchool;
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
                    RegisterSubjects::where('reg_subject_1', $first_day_people->subject)->where('account_id', $user_name[0]->account_id)->update(['priority' => '1']);
                }
            }
            $user_name = RegisterUsers::where('pid', $first_day_people->pid)->get(['id']);
            if(isset($user_name[0])){
                if(isset($user_name[0]->account_id)){
                    RegisterSubjects::where('reg_subject_1', $first_day_people->subject)->where('account_id', $user_name[0]->id)->update(['priority' => '1']);
                }
            }
            $user_name = RegisterDetails::where('name', $first_day_people->name)->get(['account_id']);
            if(isset($user_name[0])){
                if(isset($user_name[0]->account_id)){
                    RegisterSubjects::where('reg_subject_1', $first_day_people->subject)->where('account_id', $user_name[0]->account_id)->update(['priority' => '1']);
                }
            }
            $user_name = RegisterUsers::where('email', $first_day_people->email)->get(['id']);
            if(isset($user_name[0])){
                if(isset($user_name[0]->id)){
                    RegisterSubjects::where('reg_subject_1', $first_day_people->subject)->where('account_id', $user_name[0]->id)->update(['priority' => '1']);
                }
            }
        }

        foreach ($second_day as $second_day_people){
            $user_name = RegisterDetails::where('phone', $second_day_people->phone)->get(['account_id']);
            if(isset($user_name[0])){
                if(isset($user_name[0]->account_id)){
                    if($second_day_people->subject == 40005){
                        RegisterSubjects2::where('reg_subject_2','>=' , 20002)->where('reg_subject_2','<=', 20003)->where('account_id', $user_name[0]->account_id)->update(['priority' => '1']);
                    }else{
                        RegisterSubjects2::where('reg_subject_2', $second_day_people->subject)->where('account_id', $user_name[0]->account_id)->update(['priority' => '1']);
                    }

                }
            }
            $user_name = RegisterUsers::where('pid', $second_day_people->pid)->get(['id']);
            if(isset($user_name[0])){
                if(isset($user_name[0]->id)){
                    if($second_day_people->subject == 40005){
                        RegisterSubjects2::where('reg_subject_2','>=' , 20002)->where('reg_subject_2','<=', 20003)->where('account_id', $user_name[0]->id)->update(['priority' => '1']);
                    }else{
                        RegisterSubjects2::where('reg_subject_2', $second_day_people->subject)->where('account_id', $user_name[0]->id)->update(['priority' => '1']);
                    }

                }
            }
            $user_name = RegisterDetails::where('name', $second_day_people->name)->get(['account_id']);
            if(isset($user_name[0])){
                if(isset($user_name[0]->account_id)){
                    if($second_day_people->subject == 40005){
                        RegisterSubjects2::where('reg_subject_2','>=' , 20002)->where('reg_subject_2','<=', 20003)->where('account_id', $user_name[0]->account_id)->update(['priority' => '1']);
                    }else{
                        RegisterSubjects2::where('reg_subject_2', $second_day_people->subject)->where('account_id', $user_name[0]->account_id)->update(['priority' => '1']);
                    }

                }
            }
            $user_name = RegisterUsers::where('email', $second_day_people->email)->get(['id']);
            if(isset($user_name[0])){
                if(isset($user_name[0]->id)){
                    if($second_day_people->subject == 40005){
                        RegisterSubjects2::where('reg_subject_2','>=' , 20002)->where('reg_subject_2','<=', 20003)->where('account_id', $user_name[0]->id)->update(['priority' => '1']);
                    }else{
                        RegisterSubjects2::where('reg_subject_2', $second_day_people->subject)->where('account_id', $user_name[0]->id)->update(['priority' => '1']);
                    }

                }
            }
        }

        return 'SUCCESS';


    }

    public function setSelect(){



        /*
         * Priority all selected.
         */

       $subject_list = SubjectList::where('subject_id', '<', 20000)->get();



        foreach($subject_list as $subject_first_day){

            $all_capacity = $subject_first_day->subject_normal;
            $subject_code = $subject_first_day->subject_id;

            $priority_count = RegisterSubjects::where('reg_subject_1', $subject_code)->where('priority', '1')->update(['already_pick_1' => 1, 'ps' => 'PRIORITY']);

            $left_capacity = $all_capacity - $priority_count;

            $far = $left_capacity / 2;

            $reg_data = RegisterSubjects::where('reg_subject_1', $subject_code)->where('already_pick_1', '!=', '1')->get();

            foreach($reg_data as $reg_data_details){
                $user_details = RegisterDetails::where('account_id', $reg_data_details->account_id)->get();
                $user_far = FarSchool::where('sf_school_id', $user_details[0]->school)->count();

                if($user_far == 1){
                    RegisterSubjects::where('account_id', $reg_data_details->account_id)->update(['already_pick_1' => 1, 'ps' => 'FAR']);
                    $far--;
                }
                if($far == 0){
                    break;
                }
            }

            $count = RegisterSubjects::where('reg_subject_1', $subject_code)->where('already_pick_1', 1)->count();

            $normal = $all_capacity - $count;

            $reg_data = RegisterSubjects::where('reg_subject_1', $subject_code)->where('already_pick_1', '!=', '1')->get();

            foreach($reg_data as $reg_data_details){

                RegisterSubjects::where('account_id', $reg_data_details->account_id)->update(['already_pick_1' => 1, 'ps' => 'P_NORMAL']);
                $normal--;

                if($normal == 0){
                    break;
                }
            }
        }

        $subject_list = SubjectList::where('subject_id', '>', 20000)->get();

        foreach($subject_list as $subject_second_day){

            $all_capacity = $subject_second_day->subject_normal;
            $subject_code = $subject_second_day->subject_id;

            $priority_count = RegisterSubjects2::where('reg_subject_2', $subject_code)->where('priority', '1')->update(['already_pick_2' => 1, 'ps' => 'PRIORITY']);

            $left_capacity = $all_capacity - $priority_count;

            $far = $left_capacity / 2;

            $reg_data = RegisterSubjects2::where('reg_subject_2', $subject_code)->where('already_pick_2', '!=', '1')->get();

            foreach($reg_data as $reg_data_details){
                $user_details = RegisterDetails::where('account_id', $reg_data_details->account_id)->get();
                $user_far = FarSchool::where('sf_school_id', $user_details[0]->school)->count();

                if($user_far == 1){
                    RegisterSubjects2::where('account_id', $reg_data_details->account_id)->update(['already_pick_2' => 1, 'ps' => 'FAR']);
                    $far--;
                }
                if($far == 0){
                    break;
                }
            }

            $count = RegisterSubjects2::where('reg_subject_2', $subject_code)->where('already_pick_2', 1)->count();

            $normal = $all_capacity - $count;

            $reg_data = RegisterSubjects2::where('reg_subject_2', $subject_code)->where('already_pick_2', '!=', '1')->get();

            foreach($reg_data as $reg_data_details){

                RegisterSubjects2::where('account_id', $reg_data_details->account_id)->update(['already_pick_2' => 1, 'ps' => 'P_NORMAL']);
                $normal--;

                if($normal == 0){
                    break;
                }
            }
        }

        /* Giving Registration Number */

        $subject_list = SubjectList::where('subject_id', '<', 20000)->get();


        foreach($subject_list as $subject_first_day){



            if($subject_first_day->subject_id == 10001){

                $first_one = RegisterSubjects::where('reg_subject_1', $subject_first_day->subject_id)->where('already_pick_1', 1)->where('ps', 'PRIORITY')->get();
                $reg = 0;

                foreach($first_one as $first_one_things){

                    $reg++;
                    $value = str_pad($reg,3,'0',STR_PAD_LEFT);
                    $value = 'A'.$value;
                    RegisterSubjects::where('account_id', $first_one_things->account_id)->where('reg_subject_1', $first_one_things->reg_subject_1)->update(['stu_id' => $value]);

                }

                $first_one = RegisterSubjects::where('reg_subject_1', $subject_first_day->subject_id)->where('already_pick_1', 1)->where('ps', '!=', 'PRIORITY')->get();
                $reg = 0;

                foreach($first_one as $first_one_things){

                    $reg++;
                    $value = str_pad($reg,3,'0',STR_PAD_LEFT);
                    $value = 'B'.$value;
                    RegisterSubjects::where('account_id', $first_one_things->account_id)->where('reg_subject_1', $first_one_things->reg_subject_1)->update(['stu_id' => $value]);

                }


            }
            if($subject_first_day->subject_id == 10004){

                $first_one = RegisterSubjects::where('reg_subject_1', $subject_first_day->subject_id)->where('already_pick_1', 1)->get();
                $reg = 0;

                foreach($first_one as $first_one_things){

                    $reg++;
                    $value = str_pad($reg,3,'0',STR_PAD_LEFT);
                    $value = 'E'.$value;
                    RegisterSubjects::where('account_id', $first_one_things->account_id)->where('reg_subject_1', $first_one_things->reg_subject_1)->update(['stu_id' => $value]);

                }


            }

            if($subject_first_day->subject_id == 10009 || $subject_first_day->subject_id == 10006 || $subject_first_day->subject_id == 10007 || $subject_first_day->subject_id == 10008){

                $first_one = RegisterSubjects::where('reg_subject_1', 10009)->where('already_pick_1', 1)->get();
                $reg = 0;

                foreach($first_one as $first_one_things){

                    $reg++;
                    $value = str_pad($reg,3,'0',STR_PAD_LEFT);
                    $value = 'F'.$value;
                    RegisterSubjects::where('account_id', $first_one_things->account_id)->where('reg_subject_1', $first_one_things->reg_subject_1)->update(['stu_id' => $value]);

                }

                $first_one = RegisterSubjects::where('reg_subject_1', 10008)->where('already_pick_1', 1)->get();

                foreach($first_one as $first_one_things){

                    $reg++;
                    $value = str_pad($reg,3,'0',STR_PAD_LEFT);
                    $value = 'F'.$value;
                    RegisterSubjects::where('account_id', $first_one_things->account_id)->where('reg_subject_1', $first_one_things->reg_subject_1)->update(['stu_id' => $value]);

                }

                $first_one = RegisterSubjects::where('reg_subject_1', 10007)->where('already_pick_1', 1)->get();

                foreach($first_one as $first_one_things){

                    $reg++;
                    $value = str_pad($reg,3,'0',STR_PAD_LEFT);
                    $value = 'F'.$value;
                    RegisterSubjects::where('account_id', $first_one_things->account_id)->where('reg_subject_1', $first_one_things->reg_subject_1)->update(['stu_id' => $value]);

                }

                $first_one = RegisterSubjects::where('reg_subject_1', 10006)->where('already_pick_1', 1)->get();

                foreach($first_one as $first_one_things){

                    $reg++;
                    $value = str_pad($reg,3,'0',STR_PAD_LEFT);
                    $value = 'E'.$value;
                    RegisterSubjects::where('account_id', $first_one_things->account_id)->where('reg_subject_1', $first_one_things->reg_subject_1)->update(['stu_id' => $value]);

                }


            }

            if($subject_first_day->subject_id == 10002){

                $first_one = RegisterSubjects::where('reg_subject_1', $subject_first_day->subject_id)->where('already_pick_1', 1)->get();
                $reg = 0;

                foreach($first_one as $first_one_things){

                    $reg++;
                    $value = str_pad($reg,3,'0',STR_PAD_LEFT);
                    $value = 'H'.$value;

                    RegisterSubjects::where('account_id', $first_one_things->account_id)->where('reg_subject_1', $first_one_things->reg_subject_1)->update(['stu_id' => $value]);

                }


            }

            if($subject_first_day->subject_id == 10002){

                $first_one = RegisterSubjects::where('reg_subject_1', $subject_first_day->subject_id)->where('already_pick_1', 1)->get();
                $reg = 0;

                foreach($first_one as $first_one_things){

                    $reg++;
                    $value = str_pad($reg,3,'0',STR_PAD_LEFT);
                    $value = 'H'.$value;

                    RegisterSubjects::where('account_id', $first_one_things->account_id)->where('reg_subject_1', $first_one_things->reg_subject_1)->update(['stu_id' => $value]);

                }


            }
            if($subject_first_day->subject_id == 10003){

                $first_one = RegisterSubjects::where('reg_subject_1', $subject_first_day->subject_id)->where('already_pick_1', 1)->get();
                $reg = 0;

                foreach($first_one as $first_one_things){

                    $reg++;
                    $value = str_pad($reg,3,'0',STR_PAD_LEFT);
                    $value = 'G'.$value;

                    RegisterSubjects::where('account_id', $first_one_things->account_id)->where('reg_subject_1', $first_one_things->reg_subject_1)->update(['stu_id' => $value]);

                }


            }
            if($subject_first_day->subject_id == 10005){

                $first_one = RegisterSubjects::where('reg_subject_1', $subject_first_day->subject_id)->where('already_pick_1', 1)->get();
                $reg = 0;

                foreach($first_one as $first_one_things){

                    $reg++;
                    $value = str_pad($reg,3,'0',STR_PAD_LEFT);
                    $value = 'L'.$value;

                    RegisterSubjects::where('account_id', $first_one_things->account_id)->where('reg_subject_1', $first_one_things->reg_subject_1)->update(['stu_id' => $value]);

                }


            }

        }
        $subject_list = SubjectList::where('subject_id', '>', 20000)->get();


        foreach($subject_list as $subject_first_day) {


            if ($subject_first_day->subject_id == 20004) {

                $first_one = RegisterSubjects2::where('reg_subject_2', $subject_first_day->subject_id)->where('already_pick_2', 1)->get();
                $reg = 0;

                foreach ($first_one as $first_one_things) {

                    $reg++;
                    $value = str_pad($reg, 3, '0', STR_PAD_LEFT);
                    $value = 'C' . $value;
                    RegisterSubjects2::where('account_id', $first_one_things->account_id)->where('reg_subject_2', $first_one_things->reg_subject_2)->update(['stu_id' => $value]);

                }


            }

            if ($subject_first_day->subject_id == 20001) {

                $first_one = RegisterSubjects2::where('reg_subject_2', $subject_first_day->subject_id)->where('already_pick_2', 1)->get();
                $reg = 0;

                foreach ($first_one as $first_one_things) {

                    $reg++;
                    $value = str_pad($reg, 3, '0', STR_PAD_LEFT);
                    $value = 'D' . $value;
                    RegisterSubjects2::where('account_id', $first_one_things->account_id)->where('reg_subject_2', $first_one_things->reg_subject_2)->update(['stu_id' => $value]);

                }


            }

            if ($subject_first_day->subject_id == 20005) {

                $first_one = RegisterSubjects2::where('reg_subject_2', $subject_first_day->subject_id)->where('already_pick_2', 1)->get();
                $reg = 0;

                foreach ($first_one as $first_one_things) {

                    $reg++;
                    $value = str_pad($reg, 3, '0', STR_PAD_LEFT);
                    $value = 'I' . $value;
                    RegisterSubjects2::where('account_id', $first_one_things->account_id)->where('reg_subject_2', $first_one_things->reg_subject_2)->update(['stu_id' => $value]);

                }


            }

            if ($subject_first_day->subject_id == 20002 || $subject_first_day->subject_id == 20003) {

                $first_one = RegisterSubjects2::where('ps', 'PRIORITY')->where('already_pick_2', 1)->where('reg_subject_2', '>=',  20002)->where('reg_subject_2', '<=', 20003)->get();
                $reg = 0;

                foreach ($first_one as $first_one_things) {

                    $reg++;
                    $value = str_pad($reg, 3, '0', STR_PAD_LEFT);
                    $value = 'J' . $value;
                    RegisterSubjects2::where('account_id', $first_one_things->account_id)->where('reg_subject_2', $first_one_things->reg_subject_2)->update(['stu_id' => $value]);

                }

                $first_one = RegisterSubjects2::where('ps', '!=', 'PRIORITY')->where('already_pick_2', 1)->where('reg_subject_2', '>=',  20002)->where('reg_subject_2', '<=', 20003)->get();
                $reg = 0;

                foreach ($first_one as $first_one_things) {

                    $reg++;
                    $value = str_pad($reg, 3, '0', STR_PAD_LEFT);
                    $value = 'K' . $value;
                    RegisterSubjects2::where('account_id', $first_one_things->account_id)->where('reg_subject_2', $first_one_things->reg_subject_2)->update(['stu_id' => $value]);

                }


            }
        }

        return 'SUCCESS';

    }

    public function RegSMSSend(){
        $list_first_day = RegisterSubjects::where('already_pick_1', 1)->get();
        $list_second_day = RegisterSubjects2::where('already_pick_2', 1)->get();

        foreach($list_first_day as $list_first_days){
            echo $list_first_days->details->users->email;
            $rand = rand(100000,999999);
            $date = date("YmdHis");
            $pwd_file = fopen(public_path('msg_tmp/').$date.$rand.".txt","a");
            $content = "ccucc,".$list_first_days->details->phone.",夥伴您好，1/12至1/15間，務必上網印錄取通知單與填報調查。http://dream.k12cc.tw，歡迎於初春到風光明媚的中正來,";
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

            $email = $list_first_days->details->users->email;
            $name = $list_first_days->details->name;

            Mail::send('emails.enroll', ['code' => $rand], function($message) use ($email, $name)
            {
                $message->from('k12cc@ccu.edu.tw', '105偏鄉教師寒假教學專業成長研習');
                $message->to($email, $name)->subject('【第一天科目錄取通知信】105偏鄉教師寒假教學專業成長研習');
            });
        }

        foreach($list_second_day as $list_second_days){
            echo $list_second_days->details->users->email;
            $rand = rand(1000000,9999999);
            $date = date("YmdHis");
            $pwd_file = fopen(public_path('msg_tmp/').$date.$rand.".txt","a");
            $content = "ccucc,".$list_second_days->details->phone.",夥伴您好，1/12至1/15間，務必上網印錄取通知單與填報調查。http://dream.k12cc.tw，歡迎於初春到風光明媚的中正來,";
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

            $email = $list_second_days->details->users->email;
            $name = $list_second_days->details->name;

            Mail::send('emails.enroll', ['code' => $rand], function($message) use ($email, $name)
            {
                $message->from('k12cc@ccu.edu.tw', '105偏鄉教師寒假教學專業成長研習');
                $message->to($email, $name)->subject('【第二天科目錄取通知信】105偏鄉教師寒假教學專業成長研習');
            });
        }

        //$all_list = RegisterUsers::all();

        return 'SUCCESS';
    }
}
