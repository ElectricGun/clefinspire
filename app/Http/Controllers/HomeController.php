<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function show()
    {

        $logged_in_user = Auth::user();

        if ($logged_in_user == null) {
            return redirect('/');
        }

        $account_id = $logged_in_user->id;

        $user = DB::table('users')
            ->where('users.id', '=', $account_id)
            ->join('User', 'User.account_id', '=', 'users.id')
            ->join('DisplayProfile', 'DisplayProfile.user_id', '=', 'User.user_id')
            ->select('users.*', 'User.*', 'DisplayProfile.*')
            ->get();

        foreach ($user as $u) {
            $userlessons = DB::select(
                "
            SELECT l.title, SUM(uqs.is_completed) / COUNT(uqs.is_completed) as progress from UserQuestionStatus uqs 
            JOIN UserCourse uc ON uc.user_id = ?
            JOIN UserLessonStatus uls ON uls.user_id = uc.user_id AND uls.course_id = uc.course_id
            JOIN Lesson l on uls.lesson_id = l.lesson_id
            WHERE uqs.task_id = (
                SELECT uts.task_id FROM UserTaskStatus uts
                WHERE uts.lesson_id = (
                    SELECT uls.lesson_id  FROM UserCourse uc 
                    JOIN UserLessonStatus uls ON uls.user_id = uc.user_id AND uls.course_id = uc.course_id
                    WHERE uc.user_id = ?
                )
                AND uts.is_completed = 0
            )
            GROUP BY l.title, uqs.task_id
            ",
                [
                    $u->user_id,
                    $u->user_id
                ]
            );

            return view('home', [
                'user' => $user,
                'userlessons' => $userlessons
            ]);
        }
    }
}
