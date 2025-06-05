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

        $usercoursestatus = DB::table('UserCourse')
        ->where('UserCourse.user_id', '=', $userid) 
        ->join('UserLessonStatus', function($join) {
            $join->on('UserCourse.user_id', '=', 'UserLessonStatus.user_id')
                 ->on('UserCourse.course_id', '=', 'UserLessonStatus.course_id');
        })
        ->get();

        $userlessons = DB::select(
            "
            SELECT l.title, SUM(uqs.is_completed) / COUNT(uqs.is_completed) as progress from UserQuestionStatus uqs 
            JOIN UserCourse uc ON uc.user_id = 1 
            JOIN UserLessonStatus uls ON uls.user_id = uc.user_id AND uls.course_id = uc.course_id
            JOIN Lesson l on uls.lesson_id = l.lesson_id
            WHERE uqs.task_id = (
                SELECT uts.task_id FROM UserTaskStatus uts
                WHERE uts.lesson_id = (
                    SELECT uls.lesson_id  FROM UserCourse uc 
                    JOIN UserLessonStatus uls ON uls.user_id = uc.user_id AND uls.course_id = uc.course_id
                    WHERE uc.user_id = 1
                )
                AND uts.is_completed = 0
            )
            GROUP BY l.title, uqs.task_id
            "
        );

        // foreach($userlessons as $e) {
        //     echo $e->title . " " . $e->progress;
        // }

        
        return view('home', [-
            'user' => $user, 'userlessons' => $userlessons
        ]);
    }
}
