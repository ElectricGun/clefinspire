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
        <a class="h2 text-decoration-none" href="/courses/{{ $coursetype }}/{{ $courseid }}/{{ $lessonid }}">{{ $lesson_title }}</a>
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
            <div class="container">


            </div>
        </div>
        </div>
        @include('partials.level')
    @endsection

</body>

</html>
