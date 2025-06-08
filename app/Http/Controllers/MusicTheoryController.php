<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ClefinspireAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicTheoryController extends Controller
{
    public function show()
    {
        $user = ClefinspireAuth::get_user();

        return view('musictheory', ['user' => $user]);
    }
}