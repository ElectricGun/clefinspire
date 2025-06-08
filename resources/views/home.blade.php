@extends('layouts.main', ['page' => 'home'])

@section('content')
    @foreach ($user as $p)
        <div class="container mb-5">

            @include('partials.navbar', ['user' => $user])
            <div class="row text-center">
                <h1>Welcome {{ $p->display_name == null ? $p->name : $p->display_name }}!</h1>
            </div>

            <div class="row d-flex justify-content-center mt-3 align-items-stretch">
                <div class="col-12 col-md-10 col-lg-8">.
                    <div class = "row">
                        <div class="col-md-6 col-12 pe-3 pe-md-4 pe-lg-5">
                            <div
                                class="card bg-pal-red border-2 rounded-4 border-dark home-card w-100 h-100 d-flex flex-column pb-3">
                                <h5 class="fw-bold p-3 text-light"> Daily Quest </h5>

                                {{-- UNHARDCODE QUEST NAME --}}
                                <h3 class="fw-bold px-3 py-2 text-light text-center"> Complete a Course
                                </h3>

                                {{-- UNHARDCODE QUEST XP --}}
                                <div class="mt-auto text-light px-3 text-end"> Reward: 50 XP</div>
                            </div>
                        </div>


                        <div class="col-md-6 col-12 ps-3 ps-md-4 ps-lg-5 mt-4 mt-md-0">
                            <div class="card bg-pal-red border-2 rounded-4 border-dark home-card w-100 h-100">
                                <h5 class="fw-bold px-3 pt-3 m-0 text-light"> Learning Streak </h5>

                                <div class="text-center px-3 mt-4">
                                    <span class="fw-bold text-light" style="font-size: 50px">
                                        <i class="bi bi-lightning-charge-fill"></i>

                                        <span> {{ $p->user_learning_streak }} </span>
                                    </span>
                                    <span class="text-light fw-bold">
                                        {{-- plural/singular --}}
                                        Day{{ $p->user_learning_streak != 1 ? 's' : '' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class = "mt-3">Continue Learning </h3>
                    @if (sizeof($userlessons) > 0)
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
                    @else
                        <h1 class="text-muted text-center mt-5"> You have no lessons started yet</h1>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@endsection
{{-- <body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto px-0 bg-gradient-pal-red">
                <div id="sidebar" class="collapse collapse-horizontal show border-end">
                    <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100 p-0"
                        style="width: 300px">

                        <div class="container">
                            <div class="row">
                                <div class="col text-center py-5"> 
                                    <h2>Clefinspire </h2>
                                </div>
                            </div>  
                        </div>

                    </div>
                </div>
            </div>
            <div class="col p-0 m-0">
                <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse"
                    class="border rounded-3 p-1 text-decoration-none position-fixed bg-dark text-light py-5"
                    style="top: 50vh;">
                    <i class="bi bi-list bi-lg py-2 p-1"></i>
                </a>

                
            </div>
        </div>
    </div>
</body>

 --}}
