<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Theory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
@extends('layouts.main', ['page' => $coursetype])

@section('content')
    @include('partials.navbar', ['user' => $user, 'pagetitle' => $coursetitle])
        <div class="main-content">
            <div class="container">

                <div class="row">
                    <div class="col-12">
                    <div class = "card border-2 rounded-4 mt-3 pt-3 px-3 pb-2">

                        @foreach ($userlessons as $lesson)
                            <div class = "row">
                                <div class = "col-6">
                                    <span class="text-muted"> {{ $lesson->title }} </span>
                                </div>

                                <div class = "col-6 text-end">
                                    <span class="text-muted">{{ $lesson->progress * 100 . '%' }}
                                        Complete</span>
                                    <div class="progress mt-3 border border-dark rounded-5" style="min-height: 20px;">
                                        <div class="progress-bar bg-pal-red rounded-5 border border-dark"
                                            role="progressbar" style="width: {{ $lesson->progress * 100 }}%; "
                                            aria-valuenow={{ $lesson->progress * 100 }} aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>

                        <div class = "card border-2 rounded-4 mt-3 pt-3 px-3 pb-2">

                            @foreach ($userlessons as $lesson)
                                <div class = "row">
                                    <div class = "col-6">
                                        <span class="text-muted"> {{ $lesson->title }} </span>
                                    </div>

                                    <div class = "col-6 text-end">
                                        <span class="text-muted">{{ $lesson->progress * 100 . '%' }}
                                            Complete</span>
                                        <div class="progress mt-3 border border-dark rounded-5" style="min-height: 20px;">
                                            <div class="progress-bar bg-pal-red rounded-5 border border-dark"
                                                role="progressbar" style="width: {{ $lesson->progress * 100 }}%; "
                                                aria-valuenow={{ $lesson->progress * 100 }} aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class = "card border-2 rounded-4 mt-3 pt-3 px-3 pb-2">

                            @foreach ($userlessons as $lesson)
                                <div class = "row">
                                    <div class = "col-6">
                                        <span class="text-muted"> {{ $lesson->title }} </span>
                                    </div>

                                    <div class = "col-6 text-end">
                                        <span class="text-muted">{{ $lesson->progress * 100 . '%' }}
                                            Complete</span>
                                        <div class="progress mt-3 border border-dark rounded-5" style="min-height: 20px;">
                                            <div class="progress-bar bg-pal-red rounded-5 border border-dark"
                                                role="progressbar" style="width: {{ $lesson->progress * 100 }}%; "
                                                aria-valuenow={{ $lesson->progress * 100 }} aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
