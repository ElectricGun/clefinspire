<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ClefinspireAuth;

class CoursesController extends Controller
{
    public function show_music_theory()
    {
        $user = ClefinspireAuth::get_user();

        return view('courses', ['user' => $user, 'coursetype' => 'musictheory', 'coursetitle' => 'Music Theory' ]);
    }

    public function show_ear_training()
    {
        $user = ClefinspireAuth::get_user();

        return view('courses', ['user' => $user, 'coursetype' => 'eartraining', 'coursetitle' => 'Ear Training' ]);
    }
}