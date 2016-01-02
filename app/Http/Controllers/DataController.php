<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Response;
use App\Data\School;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function getSchool (Request $request){

        if ($request->type == 'primary'){
            $type = 0;
        }elseif($request->type == 'junior'){
            $type = 1;
        }

        $query_school = School::where('country', $request->id)->where('school_type', $type)->get();

        return view('register.get-school', compact('query_school'));
    }
}
