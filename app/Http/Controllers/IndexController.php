<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cache;
use Carbon\Carbon;
use App\Register\RegisterUsers;
use App\Register\RegisterDetails;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function Index (){

        $expiresAt = Carbon::now()->addMinutes(10);

        if(Cache::has('TimeControlling')){
            $previous_renew_time = Cache::get('TimeControlling');

            $diffMinutes = $previous_renew_time->diffInMinutes();

            if($diffMinutes >= 10){
                Cache::put('TimeControlling', Carbon::now(), $expiresAt);
            }

        }else{
            Cache::add('TimeControlling', Carbon::now(), $expiresAt);
            $previous_renew_time = Cache::get('TimeControlling');
        }



        if (Cache::has('primary_count')) {
            if($diffMinutes >= 10){
                Cache::put('primary_count', RegisterUsers::where('type', 'primary')->count(), $expiresAt);
            }
            $primary_count = Cache::get('primary_count', '請重新整理一次');
        }else{
            Cache::add('primary_count', RegisterUsers::where('type', 'primary')->count(), $expiresAt);
        }

        if (Cache::has('junior_count')) {
            if($diffMinutes >= 10){
                Cache::put('junior_count', RegisterUsers::where('type', 'junior')->count(), $expiresAt);
            }
            $junior_count = Cache::get('junior_count', '請重新整理一次');
        }else{
            Cache::add('junior_count', RegisterUsers::where('type', 'junior')->count(), $expiresAt);
        }



        return view('index', compact('primary_count', 'junior_count'));

    }
}
