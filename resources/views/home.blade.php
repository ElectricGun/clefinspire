<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>

    @include('partials.style_head')
</head>

<body>
    @include('partials.navbar', ['user' => $user])

    {{-- [{"user_learning_streak":0,"user_xp":0,"user_subscription":0,"user_level":0,"account_id":1,"user_id":1,"display_name":"Artyom","bio":null,"status":null,"profile_picture":null}] --}}

    @foreach ($user as $p)
        <div class="container">
            <div class="row text-center">
                <h1>Welcome {{ $p->display_name == null ? $p->name : $p->display_name }}!</h1>
            </div>

            <div class="row d-flex justify-content-center mt-3">
                <div class="col-12 col-md-10 col-lg-8">.
                    <div class = "row">
                        <div class="col-lg-6 col-6 pe-3 pe-md-4 pe-lg-5">
                            <div
                                class="card bg-pal-red border-2 rounded-4 border-dark home-card w-100 d-flex flex-column pb-3">
                                <h5 class="fw-bold p-3 text-light"> Daily Quest </h5>

                                {{-- UNHARDCODE QUEST NAME --}}
                                <h3 class="fw-bold px-3 py-2 text-light text-center"> Complete a Course </h3>

                                {{-- UNHARDCODE QUEST XP --}}
                                <div class="mt-auto text-light px-3 text-end"> Reward: 50 XP</div>
                            </div>
                        </div>


                        <div class="col-lg-6 col-6 ps-3 ps-md-4 ps-lg-5">
                            <div class="card bg-pal-red border-2 rounded-4 border-dark home-card w-100">
                                <h5 class="fw-bold p-3 text-light"> Learning Streak </h5>

                                <div class="text-center px-3 py-2">
                                    <span class="fw-bold text-light" style="font-size: 50px"> 
                                        <i class="bi bi-lightning-charge-fill"></i>
                                        {{$p->user_learning_streak}} 
                                    </span>
                                    <span class="text-light fw-bold">
                                    Day{{$p->user_learning_streak != 1 ? 's' : ''}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class = "mt-3">Continue Learning </h3>
                    @if(sizeof($userlessons) > 0)
                    <div class = "card border-2 rounded-4 mt-3 pt-3 px-3 pb-2">

                        @foreach ($userlessons as $lesson)
                            <div class = "row">
                                <div class = "col-6">
                                    <span class="text-muted"> {{ $lesson->title }} </span>
                                </div>

                                <div class = "col-6 text-end">
                                    <span class="text-muted">{{ $lesson->progress * 100 . '%' }} Complete</span>
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
</body>
