<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ClefinspireAuth;
use App\Providers\UserProfileProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    public static function show(Request $request, $courseid, $lessonid, $coursetype, $pagetitle)
    {
        $user = ClefinspireAuth::get_user();
        $display_profile = UserProfileProvider::get_user_profile($user->account_id);

        $tasks = DB::select(
            "
            select 
                case 
                    when exists (
                        select 1 
                        from Task t2 
                        left join UserTaskStatus uts2 on uts2.task_id = tp.prerequisite_id
                        where t2.task_id = t.task_id
                        and uts2.user_id = ?
                        or tp.prerequisite_id is null
                    ) then true
                    else false
                end as prerequisite_completed, uts.is_completed,
            tp.prerequisite_id, c.course_id, l.lesson_id, t.task_id, c.course_name, l.title as lesson_title, t.title as task_title, t.task_completion_xp_reward, coalesce(sum(uqs.is_completed) / count(uqs.question_id), 0) as progress
            from Course c 
            left join UserCourse uc on c.course_id = uc.course_id and user_id = ?
            left join Lesson l on l.course_id = c.course_id
            left join Task t on t.lesson_id = l.lesson_id
            left join Question q on q.task_id = t.task_id 
            left join TaskPrerequisites tp on tp.task_id = t.task_id 
            left join UserLessonStatus uls on uls.lesson_id = l.lesson_id and uls.user_id = ? 
            left join UserTaskStatus uts on uts.task_id = t.task_id and uts.user_id = ?
            left join UserQuestionStatus uqs on uqs.question_id = q.question_id and uqs.user_id = ?
            where c.course_type = ?
            and l.course_id = ?
            and l.lesson_id = ?
            group by prerequisite_completed, uts.is_completed,
            tp.prerequisite_id, c.course_id, l.lesson_id, t.task_id, c.course_name, l.title, t.title, t.task_completion_xp_reward
            order by t.task_id 
            ",
            [
                $user->user_id,
                $user->user_id,
                $user->user_id,
                $user->user_id,
                $user->user_id,
                $coursetype,
                $courseid,
                $lessonid,
            ]
        );

        return view('lesson', [
            'pagetitle' => $pagetitle,
            'course_name' => ($tasks[0]->course_name),
            'user' => $user,
            'display_profile' => $display_profile,
            'tasks' => $tasks,
            'coursetype' => $coursetype,
            'courseid' => $courseid,
            'lessonid' => $lessonid,
            'lesson_title' => ($tasks[0]->lesson_title)
        ]);
    }

    public function show_music_theory(Request $request, $courseid, $lessonid)
    {
        return LessonController::show($request, $courseid, $lessonid, 'musictheory', 'Music Theory');
    }

    public function show_ear_training(Request $request, $courseid, $lessonid,)
    {
        return LessonController::show($request, $courseid, $lessonid, 'eartraining', 'Ear Training');
    }
}
