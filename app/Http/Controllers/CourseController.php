<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function show()
    {
    //reminder to learn CRUD more
    	$user = DB::table('User')->get();
        return view('musictheory',['user' => $user]);
    }
    
}