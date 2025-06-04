<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function show() {

        // $userid = Auth::user();

        // echo $userid;

        $userid = 1;

        $user = DB::table('User')
        ->where('User.user_id','=', $userid)
        ->join('DisplayProfile', 'DisplayProfile.user_id', '=', 'User.user_id')
        ->select('User.*', 'DisplayProfile.*')
        ->get();

        $course = DB::table('UserCourse')
        ->where('UserCourse.user_id', '=', $userid) 
        ->get();

        return view('home', [
            'user' => $user, 'course' => $course
        ]);
    }
}
