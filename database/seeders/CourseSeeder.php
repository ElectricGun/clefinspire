<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $course_name = "SeededCourse3";
        $course_type = "musictheory";

        DB::table('Course')->insert([
            'difficulty' => 1,
            'course_type' => $course_type,
            'course_name' => $course_name
        ]);

        $course_id = DB::table('Course')
            ->where('course_name', '=', $course_name)
            ->where('course_type', '=', $course_type)
            ->orderBy('course_id', 'desc')
            ->first()->course_id;

        // Lesson

        for ($l = 0; $l < 10; $l++) {
            $lesson_title = "Lesson " . $l;
            $lesson_xp = 1000;

            DB::table('Lesson')->insert([
                'lesson_completion_xp_reward' => $lesson_xp,
                'course_id' => $course_id,
                'title' => $lesson_title,
            ]);

            $lesson_id = DB::table('Lesson')
                ->where('title', '=', $lesson_title)
                ->orderBy('lesson_id', 'desc')
                ->first()->lesson_id;

            // Task

            // Create initial
            $task_xp = 1000;

            $previous_task_id = null;

            $create_task = function ($title, $preq = null) use (&$task_xp, &$lesson_id, &$previous_task_id) {

                // because circular dependency
                DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

                DB::table('Task')->insert([
                    'title' => $title,
                    'task_completion_xp_reward' => $task_xp,
                    'lesson_id' => $lesson_id,
                    'prerequisite_id' => $preq
                ]);

                $previous_task_id = DB::table('Task')
                    ->where('title', '=', $title)
                    ->where('lesson_id', '=', $lesson_id)
                    ->orderBy('task_id', 'desc')
                    ->first()->task_id;

                if ($preq !== null) {
                    DB::table('TaskPrerequisites')->insert([
                        'task_id' => $previous_task_id,
                        'prerequisite_id' => $preq
                    ]);
                }

                DB::statement('SET FOREIGN_KEY_CHECKS = 1;');


                for ($q = 0; $q < 10; $q++) {
                    $question_title = "Question" . $q + 1;

                    if ($q % 2 == 0) {
                        $is_text = true;
                        $answer_text = "test";

                        DB::table('Question')->insert([
                            'title' => $question_title,
                            'task_id' => $previous_task_id,
                            'answer_text' => $answer_text,
                            'is_text_question_flag' => $is_text
                        ]);
                    } else {
                        $is_text = false;
                        $answer_id = 0;

                        DB::table('Question')->insert([
                            'title' => $question_title,
                            'task_id' => $previous_task_id,
                            'answer_id' => $answer_id,
                            'is_text_question_flag' => $is_text
                        ]);

                        $question_id = DB::table('Question')
                        ->where('title', '=', $question_title)
                        ->orderBy('question_id', 'desc')
                        ->first()->question_id;

                        for ($c = 0; $c < 4; $c++) {
                            DB::table('QuestionChoice')->insert([
                                'choice_number' => $c,
                                'description' => "Choice",
                                'question_id' => $question_id,
                                'text_size' => 1
                            ]);
                        }
                    }
                }
            };

            $create_task("Task " . 1);

            for ($t = 1; $t < 10; $t++) {
                $task_title = "Task " . $t + 1;

                $create_task($task_title, $previous_task_id);
            }
        }
    }
}
