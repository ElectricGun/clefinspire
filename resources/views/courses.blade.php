@extends('layouts.main', ['page' => $coursetype])

@section('title')
    Clefinspire - {{$pagetitle}}
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

    @section('content')
        @include('partials.navbar', [
            'user' => $user,
            'display_profile' => $display_profile,
            'pagetitle' => $pagetitle,
        ])
        
        <div class="main-content">
            <div class="container">

                <div class="row d-flex justify-content-center">
                    <div class="col-8">
                        @foreach ($courses as $course)
                            <a href="{{$coursetype}}/{{$course->course_id}}" class = "card border-2 rounded-4 mt-3 pt-3 px-3 pb-2 text-decoration-none">
                                <div class = "row">
                                    <div class = "col-6">
                                        <h2 class="text-muted"> {{ $course->course_name }} </h2>
                                    </div>

                                    <div class = "col-6 text-end">
                                        <div class="text-muted mb-5">{{ $course->progress * 100 . '%' }}
                                            Complete</div>
                                        <div class="progress mt-3 border border-dark rounded-5" style="min-height: 20px;">
                                            <div class="progress-bar bg-pal-red rounded-5 border border-dark"
                                                role="progressbar" style="width: {{ $course->progress * 100 }}%; "
                                                aria-valuenow={{ $course->progress * 100 }} aria-valuemin="0"
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
    @endsection

</body>

</html>
