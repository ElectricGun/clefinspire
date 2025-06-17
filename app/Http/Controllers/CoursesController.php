<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ClefinspireAuth;
use Illuminate\Support\Facades\DB;
use App\Providers\UserProfileProvider;

class CoursesController extends Controller
{

    public static function show($coursetype, $coursetitle) {
        $user = ClefinspireAuth::get_user();
        $display_profile = UserProfileProvider::get_user_profile($user->last()->account_id);

        foreach ($user as $u) {
            $courses = DB::select(
                "
                select c.difficulty, c.course_name, c.course_id, coalesce(sum(uts.is_completed) / count(t.task_id), 0) as progress
                from Course c 
                left join UserCourse uc on c.course_id = uc.course_id and user_id = ?
                left join Lesson l on l.course_id = c.course_id
                left join Task t on t.lesson_id = l.lesson_id
                left join UserLessonStatus uls on uls.course_id = uc.course_id
                left join UserTaskStatus uts on uls.lesson_id = uts.course_id
                where c.course_type = '$coursetype'
                group by c.course_type, c.difficulty, c.course_name, c.course_id
                having count(t.task_id) > 0
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
                    'coursetype' => $coursetype,
                    'coursetitle' => $coursetitle
                ]
            );
        }
    }

    public function show_music_theory()
    {
        return CoursesController::show('musictheory', 'Music Theory');
    }

    public function show_ear_training()
    {
        return CoursesController::show('eartraining', 'Ear Training');
    }
}
