<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ClefinspireAuth;
use App\Providers\UserProfileProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function show_music_theory(Request $request, $courseid, $lessonid, $taskid,)
    {
        return TaskController::show($request, $courseid, $lessonid, $taskid, 'musictheory', "Music Theory");
    }

    public function show_ear_training(Request $request, $courseid, $lessonid, $taskid)
    {
        return TaskController::show($request, $courseid, $lessonid, $taskid, 'eartraining', "Ear Training");
    }

    public static function show(Request $request, $courseid, $lessonid, $taskid, $coursetype, $pagetitle)
    {

        // ADD SOME ISUNLOCKED VALIDATION

        $user = ClefinspireAuth::get_user();
        $display_profile = UserProfileProvider::get_user_profile($user->account_id);

        $questions = DB::select(
            "
            select 
            c.course_type, c.course_id, l.lesson_id, t.task_id, q.question_id,
            c.course_name, l.title as lesson_title, t.title as task_title,
            q.is_text_question_flag, q.title as question_title
            from Course c 
            left join UserCourse uc on c.course_id = uc.course_id and user_id = ?
            left join Lesson l on l.course_id = c.course_id
            left join Task t on t.lesson_id = l.lesson_id
            left join Question q on q.task_id = t.task_id 
            left join UserQuestionStatus uqs on uqs.question_id = q.question_id and uqs.user_id = ?
            where c.course_id = ?
            and l.lesson_id = ?
            and t.task_id = ?
            group by
            c.course_type, c.course_id, l.lesson_id, t.task_id, q.question_id,
            c.course_name, l.title, t.title,
            q.is_text_question_flag, q.title
            ",
            [
                $user->user_id,
                $user->user_id,
                $courseid,
                $lessonid,
                $taskid

            ]
        );

        return view('task', [
            'pagetitle' => $pagetitle,
            'course_name' => $questions[0]->course_name,
            'user' => $user,
            'display_profile' => $display_profile,
            'questions' => $questions,
            'coursetype' => $coursetype,
            'courseid' => $courseid,
            'lessonid' => $lessonid,
            'taskid' => $taskid,
            'lesson_title' => $questions[0]->lesson_title,
            'task_title' => $questions[0]->task_title
        ]);
    }
}
