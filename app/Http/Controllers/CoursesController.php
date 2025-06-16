<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ClefinspireAuth;
use Illuminate\Support\Facades\DB;
use App\Providers\UserProfileProvider;

class CoursesController extends Controller
{
    public function show_music_theory()
    {
        $user = ClefinspireAuth::get_user();
        $display_profile = UserProfileProvider::get_user_profile($user->last()->user_id);

        foreach ($user as $u) {
            $courses = DB::select(
                "
                select * 
                from Course c 
                left join UserCourse uc on c.course_id = uc.course_id and user_id = ?
                where c.course_type = 'musictheory'
                ",
                [
                    $u->user_id
                ]
            );

            return view(
                'courses',
                [
                    'user' => $user,
                    'courses' => $courses,
                    'display_profile' => $display_profile,
                    'coursetype' => 'musictheory',
                    'coursetitle' => 'Music Theory'
                ]
            );
        }
    }

    public function show_ear_training()
    {
        $user = ClefinspireAuth::get_user();
        $display_profile = UserProfileProvider::get_user_profile($user->last()->user_id);
        
        foreach ($user as $u) {
            $courses = DB::select(
                "
                select * 
                from Course c 
                left join UserCourse uc on c.course_id = uc.course_id and user_id = ?
                where c.course_type = 'eartraining'
                ",
                [
                    $u->user_id
                ]
            );

            return view(
                'courses',
                [
                    'user' => $user,
                    'courses' => $courses,
                    'display_profile' => $display_profile,
                    'coursetype' => 'eartraining',
                    'coursetitle' => 'Ear Training'
                ]
            );
        }
    }
}
