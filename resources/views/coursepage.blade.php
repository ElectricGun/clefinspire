@extends('layouts.main', ['page' => $coursetype])

@section('title')
    Clefinspire - {{ $pagetitle }}
@endsection

<head>
    <style>
        .main-content {
            padding: 20px;
            padding-bottom: 400px;
            width: 100%;
        }

        .progress-bar {
            background-color: #f89d9d;
        }
    </style>
</head>

<body>

    @section('pagetitle')
        <a class="h2 text-decoration-none" href="/courses/{{ $coursetype }}">{{ $pagetitle }}</a>
        <span class="h2"> - </span>
        <a class="h2 text-decoration-none" href="{{ $courseid }}">{{$course_name}}</a>
    @endsection

    @section('content')
        @include('partials.navbar', [
            'user' => $user,
            'display_profile' => $display_profile,
            'disable_default_title' => true,
            'search_enabled' => false
        ])

        <div class="main-content">
            <div class="container">

                <div class="row d-flex justify-content-center">
                    <div class="col-8">
                        @foreach ($lessons as $lesson)
                            <a class = "card border-2 rounded-4 mt-3 pt-3 px-3 pb-2 text-decoration-none"
                                href="{{ $courseid }}/{{ $lesson->lesson_id }}">
                                <div class = "row">
                                    <div class = "col-6">
                                        <h2 class="text-muted"> {{ $lesson->title }} </h2>
                                    </div>

                                    <div class = "col-6 text-end">
                                        <div class="text-muted mb-5">{{ $lesson->progress * 100 . '%' }}
                                            Complete</div>
                                        <div class="progress mt-3 border border-dark rounded-5" style="min-height: 20px;">
                                            <div class="progress-bar bg-pal-red rounded-5 border border-dark"
                                                role="progressbar" style="width: {{ $lesson->progress * 100 }}%; "
                                                aria-valuenow={{ $lesson->progress * 100 }} aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>
        @include('partials.level')
    @endsection

</body>

</html>
