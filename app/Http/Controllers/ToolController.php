<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
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

    public function setSelect(){



        /*
         * Priority all selected.
         */

       /* $subject_list = SubjectList::where('subject_id', '<', 20000)->get();



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
        }*/

        /* Giving Registration Number */

        $subject_list = SubjectList::where('subject_id', '<', 20000)->get();


        foreach($subject_list as $subject_first_day){



            if($subject_first_day->subject_id == 10001){

                $first_one = RegisterSubjects::where('reg_subject_1', $subject_first_day->subject_id)->where('ps', 'PRIORITY')->get();
                $reg = 0;

                foreach($first_one as $first_one_things){

                    $reg++;
                    $value = str_pad($reg,3,'0',STR_PAD_LEFT);
                    $value = 'A'.$value;
                    RegisterSubjects::where('account_id', $first_one_things->account_id)->where('reg_subject_1', $first_one_things->reg_subject_1)->update(['stu_id' => $value]);

                }

                $first_one = RegisterSubjects::where('reg_subject_1', $subject_first_day->subject_id)->where('ps', '!=', 'PRIORITY')->get();
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

                $first_one = RegisterSubjects2::where('reg_subject_2', $subject_first_day->subject_id)->get();
                $reg = 0;

                foreach ($first_one as $first_one_things) {

                    $reg++;
                    $value = str_pad($reg, 3, '0', STR_PAD_LEFT);
                    $value = 'D' . $value;
                    RegisterSubjects2::where('account_id', $first_one_things->account_id)->where('reg_subject_2', $first_one_things->reg_subject_2)->update(['stu_id' => $value]);

                }


            }

            if ($subject_first_day->subject_id == 20005) {

                $first_one = RegisterSubjects2::where('reg_subject_2', $subject_first_day->subject_id)->get();
                $reg = 0;

                foreach ($first_one as $first_one_things) {

                    $reg++;
                    $value = str_pad($reg, 3, '0', STR_PAD_LEFT);
                    $value = 'I' . $value;
                    RegisterSubjects2::where('account_id', $first_one_things->account_id)->where('reg_subject_2', $first_one_things->reg_subject_2)->update(['stu_id' => $value]);

                }


            }

            if ($subject_first_day->subject_id == 20002 || $subject_first_day->subject_id == 20003) {

                $first_one = RegisterSubjects2::where('reg_subject_2', $subject_first_day->subject_id)->where('ps', 'PRIORITY')->get();
                $reg = 0;

                foreach ($first_one as $first_one_things) {

                    $reg++;
                    $value = str_pad($reg, 3, '0', STR_PAD_LEFT);
                    $value = 'J' . $value;
                    RegisterSubjects2::where('account_id', $first_one_things->account_id)->where('reg_subject_2', $first_one_things->reg_subject_2)->update(['stu_id' => $value]);

                }

                $first_one = RegisterSubjects2::where('reg_subject_2', $subject_first_day->subject_id)->where('ps', '!=', 'PRIORITY')->get();
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
}
