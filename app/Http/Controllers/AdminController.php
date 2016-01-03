<?php

namespace App\Http\Controllers;

use App\Data\School;
use Auth;
use Hash;
use App\Settings\Settings;
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

        return view('general.index', compact('user_details', 'user_data', 'settings_value', 'user_reg_subject_1', 'user_reg_subject_2', 'user_reg_subject_1_displayName', 'user_reg_subject_2_displayName', 'user_school_displayName'));

    }

    public function UpdateView (){

        $user_data = RegisterUsers::where('email', Auth::user()->email)->get();

        $user_details = RegisterDetails::where('account_id', $user_data[0]->id)->get();

        return view('general.update', compact('user_details', 'user_data'));
    }

    public function Update (Requests\UpdateCheck $request) {

        $account_details = RegisterUsers::where('email', Auth::user()->email)->get();

        if($request->get('password') != ''){
            RegisterUsers::where('email', Auth::user()->email)
                ->update([
                    'password' => Hash::make($request->get('password'))
                ]);
        }
        RegisterDetails::where('account_id', $account_details[0]->id)
            ->update([
                'name' => $request->get('name'),
                'phone' => $request->get('phone')
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

        $total_count = RegisterUsers::where('type','<>','super')->count();

        $settings_value = Settings::all();

        return view('console.index', compact('settings_value', 'subject_list_1', 'subject_list_2', 'subject_count_1', 'subject_count_2', 'total_count'));

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

        $user_details = RegisterDetails::all();

        return view('console.member-query', compact('user_details'));

    }
}
