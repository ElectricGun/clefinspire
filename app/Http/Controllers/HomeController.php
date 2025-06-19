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

        $display_profile = UserProfileProvider::get_user_profile($user->account_id);

        $userlessons = DB::select(
            "
            select c.course_id, c.course_type, l.lesson_id, l.title, l.lesson_completion_xp_reward, coalesce(sum(uts.is_completed) / count(t.task_id), 0) as progress
            from Course c 
            left join UserCourse uc on c.course_id = uc.course_id and user_id = ?
            left join Lesson l on l.course_id = c.course_id
            left join Task t on t.lesson_id = l.lesson_id
            left join UserLessonStatus uls on uls.lesson_id = l.lesson_id and uls.user_id = ?
            left join UserTaskStatus uts on uts.task_id = t.task_id and uts.user_id = ?
            group by c.course_id, c.course_type, l.lesson_id, l.title, l.lesson_completion_xp_reward
            having progress > 0 and progress < 1
            ",
            [
                $user->user_id,
                $user->user_id,
                $user->user_id
            ]
        );
        $streakData = null;
        $userId = $user->user_id;

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
