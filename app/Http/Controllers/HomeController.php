<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ClefinspireAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Streak;
use App\Providers\UserProfileProvider;

class HomeController extends Controller
{
    public function show()
    {
        $user = ClefinspireAuth::get_user();

        if ($user === null) {
            return redirect("/landing");
        }
        
        $display_profile = UserProfileProvider::get_user_profile($user->last()->account_id);

        foreach ($user as $u) {
            $userlessons = DB::select(
                // query can be simplified
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
            $streakData = null;
            $userId = $u->user_id;
            
            $hasStreak = Streak::checkHasStreak($userId);
            
            if ($hasStreak) {
                $streakData = [
                    'streak_count' => Streak::getUserStreak($userId),
                    'has_streak' => true
                ];
            } else {
                $streakData = [
                    'has_streak' => false,
                    'message' => Streak::getMotivationalMessage()
                ];
            }

            return view('home', [
                'user' => $user,
                'userlessons' => $userlessons,
                'streakData' => $streakData,
                'display_profile' => $display_profile
            ]);
        }
    }
}
