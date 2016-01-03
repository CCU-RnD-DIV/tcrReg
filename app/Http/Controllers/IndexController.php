<?php

namespace App\Http\Controllers;

use Hamcrest\Core\Set;
use Illuminate\Http\Request;

use Cache;
use Carbon\Carbon;
use App\Register\RegisterUsers;
use App\Register\RegisterDetails;
use App\Register\RegisterSubjects;
use App\Register\RegisterSubjects2;
use App\Register\SubjectList;
use App\Settings\Settings;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function Index (){

        $settings_value = Settings::all();

        $expiresAt = Carbon::now()->addMinutes(10);

        if(Cache::has('TimeControlling')){
            $previous_renew_time = Cache::get('TimeControlling');

            $diffMinutes = $previous_renew_time->diffInMinutes();

            if($diffMinutes >= 10){
                Cache::put('TimeControlling', Carbon::now(), $expiresAt);
            }

        }else{
            Cache::add('TimeControlling', Carbon::now(), $expiresAt);
            $diffMinutes = 0;
        }

        $subject_list_1 = SubjectList::where('subject_id', '<', 20000)->get();
        
        for($i = 0; $i < 9; $i ++){
            if(Cache::has($subject_list_1[$i]->subject_id)){
                if($diffMinutes >= 10){
                    Cache::put($subject_list_1[$i]->subject_id, RegisterSubjects::where('reg_subject_1', $subject_list_1[$i]->subject_id)->count(), $expiresAt);
                }
                $subject_count_1[$subject_list_1[$i]->subject_id] = Cache::get($subject_list_1[$i]->subject_id, '請重新整理一次');
            }else{
                Cache::add($subject_list_1[$i]->subject_id, RegisterSubjects::where('reg_subject_1', $subject_list_1[$i]->subject_id)->count(), $expiresAt);
                $subject_count_1[$subject_list_1[$i]->subject_id] = Cache::get($subject_list_1[$i]->subject_id, '請重新整理一次');
            }
        }

        $subject_list_2 = SubjectList::where('subject_id', '>', 20000)->get();

        for($i = 0; $i < 5; $i ++){
            if(Cache::has($subject_list_2[$i]->subject_id)){
                if($diffMinutes >= 10){
                    Cache::put($subject_list_2[$i]->subject_id, RegisterSubjects2::where('reg_subject_2', $subject_list_2[$i]->subject_id)->count(), $expiresAt);
                }
                $subject_count_2[$subject_list_2[$i]->subject_id] = Cache::get($subject_list_2[$i]->subject_id, '請重新整理一次');
            }else{
                Cache::add($subject_list_2[$i]->subject_id, RegisterSubjects2::where('reg_subject_2', $subject_list_2[$i]->subject_id)->count(), $expiresAt);
                $subject_count_2[$subject_list_2[$i]->subject_id] = Cache::get($subject_list_2[$i]->subject_id, '請重新整理一次');
            }
        }





        return view('index', compact('subject_list_1', 'subject_list_2', 'subject_count_1', 'subject_count_2', 'settings_value'));

    }
}
