@extends('layouts.main', ['page' => $coursetype, 'sidebar_start_collapsed' => true])

@section('title')
    Clefinspire - {{ $pagetitle }}
@endsection

<head>
    <style>
        .main-content {
            padding: 20px;
            width: 100%;
        }

        .progress-bar {
            background-color: #f89d9d;
        }
    </style>
</head>

<body>

    @section('pagetitle')
        <span>
            <a class="h2 text-decoration-none" href="/courses/{{ $coursetype }}/{{ $courseid }}">{{ $course_name }}</a>
            <span class="h2">&nbsp;-&nbsp;</span>
            <a class="h2 text-decoration-none"
                href="/courses/{{ $coursetype }}/{{ $courseid }}/{{ $lessonid }}">{{ $lesson_title }}</a>
            <span class="h2">&nbsp;-&nbsp;</span>
            <a class="h2 text-decoration-none">{{ $task_title }}</a>
        </span>
    @endsection

    @section('content')
        @include('partials.navbar', [
            'user' => $user,
            'display_profile' => $display_profile,
            'disable_default_title' => true,
            'search_enabled' => false,
        ])

        <div class="main-content">
            <h1>Question {{ $question_number + 1 }} </h1>
            <div class="container">
                <div class="mt-4 row d-flex justify-content-center">
                    <div class="col-8 col-md-6 col-lg-4 card border-2 rounded-4" style="min-height: 250px">
                    </div>
                </div>
            </div>

            <div class="mt-5 row d-flex justify-content-center">
                @if ($question_number > 0)
                <a href="{{$taskid}}?q={{$question_number-1}}" class="h1 mx-5 card border-1 col-1 text-center text-decoration-none"> < </a>
                @else
                <div class="h1 mx-5 card col-1 text-center"> &nbsp; </div>
                @endif
                
                @if ($question_number < $question_count - 1)
                <a href="{{$taskid}}?q={{$question_number+1}}" class="h1 mx-5 card border-1 col-1 text-center text-decoration-none"> > </a>
                @else 
                <div class="h1 mx-5 card col-1 text-center"> &nbsp; </div>
                @endif
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-11">

                    <h3 class="mt-3"> {{ $question->question_title }} </h3>

                    @if ($question->is_text_question_flag == true)
                    @else
                        <div class="row my-4 d-flex justify-content-between">
                            <div class="col mx-2 card border-1 rounded-4 d-flex justify-content-center"
                                style="min-height: 100px">
                                <p class="fs-2 mb-0 mx-5">a. {{ $selections[0]->description }}</p>
                            </div>
                            <div class="col mx-2 card border-1 rounded-4 d-flex justify-content-center"
                                style="min-height: 100px">
                                <p class="fs-2 mb-0 mx-5">c. {{ $selections[2]->description }}</p>
                            </div>
                        </div>
                        <div class="row my-4 d-flex justify-content-between">
                            <div class="col mx-2 card border-1 rounded-4 d-flex justify-content-center"
                                style="min-height: 100px">
                                <p class="fs-2 mb-0 mx-5">b. {{ $selections[1]->description }}</p>
                            </div>
                            <div class="col mx-2 card border-1 rounded-4 d-flex justify-content-center"
                                style="min-height: 100px">
                                <p class="fs-2 mb-0 mx-5">d. {{ $selections[3]->description }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection

</body>

</html>
