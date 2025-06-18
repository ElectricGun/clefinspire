<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ClefinspireAuth;
use App\Providers\UserProfileProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursePageController extends Controller
{
    public static function show(Request $request, $courseid, $coursetype, $pagetitle)
    {

        $user = ClefinspireAuth::get_user();
        $display_profile = UserProfileProvider::get_user_profile($user->account_id);

        $lessons = DB::select(
            "
            select c.course_name, l.lesson_id, l.title, l.lesson_completion_xp_reward, coalesce(sum(uts.is_completed) / count(t.task_id), 0) as progress
            from Course c 
            left join UserCourse uc on c.course_id = uc.course_id and user_id = ?
            left join Lesson l on l.course_id = c.course_id
            left join Task t on t.lesson_id = l.lesson_id
            left join UserLessonStatus uls on uls.lesson_id = l.lesson_id and uls.user_id = ? 
            left join UserTaskStatus uts on uts.task_id = t.task_id and uts.user_id = ?
            where c.course_type = ? and l.course_id = ?
            group by c.course_name, l.lesson_id, l.title, l.lesson_completion_xp_reward
            ",
            [
                $user->user_id,
                $user->user_id,
                $user->user_id,
                $coursetype,
                $courseid
            ]
        );

        return view('coursepage', [
            'pagetitle' => $pagetitle,
            'course_name' => ($lessons[0]->course_name),
            'user' => $user,
            'display_profile' => $display_profile,
            'lessons' => $lessons,
            'coursetype' => $coursetype,
            'courseid' => $courseid
        ]);
    }

    public function show_music_theory(Request $request, $courseid)
    {
        return CoursePageController::show($request, $courseid, 'musictheory', 'Music Theory');
    }

    public function show_ear_training(Request $request, $courseid)
    {
        return CoursePageController::show($request, $courseid, 'eartraining', 'Ear Training');
    }
}
