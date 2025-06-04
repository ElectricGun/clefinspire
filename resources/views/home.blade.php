<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        .bg-pal-red {
            background: #EE6464 !important;
        }

        .home-card {
            min-height: 180px !important;
        }

        html * {
            font-family: 'Poppins' !important;
        }
    </style>
</head>

<body>
    @include('partials.navbar', ['user' => $user])

    {{-- [{"user_learning_streak":0,"user_xp":0,"user_subscription":0,"user_level":0,"account_id":1,"user_id":1,"display_name":"Artyom","bio":null,"status":null,"profile_picture":null}] --}}

    @foreach($user as $p)

    <div class="container">
        <div class="row text-center">
            <h1>Welcome {{ $p->display_name}}!</h1>
        </div>

        <div class="row d-flex justify-content-center mt-3">
            <div class="col-12 col-md-10 col-lg-8">.
                <div class = "row">
                    <div class="col-lg-6 col-6 pe-3 pe-md-4 pe-lg-5">
                        <div class="card bg-pal-red border-2 rounded-4 border-dark home-card w-100 d-flex flex-column pb-3">
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
                                <h1 class="fw-bold text-light" style="font-size: 50px"> 1 </h1>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

                <h3 class = "mt-3">Continue Learning </h3>

                <div class = "card border-2 rounded-4 mt-3 pt-3 px-3 pb-2">

                    @foreach($course as $c)
                    <div class = "row">
                        <div class = "col-6">
                            <span class="text-muted"> INSERT COURSE NAME </span>
                        </div>

                        <div class = "col-6 text-end">
                            {{-- UNHARDCODE --}}
                            <span class="text-muted">80% Complete</span>
                            
                            {{-- UNHARDCODE --}}
                            <div class="progress mt-3 border border-dark rounded-5" style="min-height: 20px;">
                                <div class="progress-bar bg-pal-red rounded-5 border border-dark" role="progressbar" style="width: 25%; " aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</body>
