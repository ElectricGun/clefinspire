@extends('layouts.main', ['page' => 'home'])

@section('content')
    @foreach ($user as $p)
        <div class="container mb-5">

            {{-- Navbar --}}
            @include('partials.navbar', ['user' => $user, 'pagetitle' => 'Home'])

            {{-- Welcome Message --}}
            <div class="row text-center">
                <h1>
                    Welcome {{ $p->display_name ?? $p->name }}!
                </h1>
            </div>

            

            {{-- Cards Section --}}
            <div class="row d-flex justify-content-center mt-3 align-items-stretch">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="row">

                        {{-- Daily Quest Card --}}
                        <div class="col-md-6 col-12 pe-3 pe-md-4 pe-lg-5">
                            <div class="card bg-pal-red border-2 rounded-4 border-dark home-card w-100 h-100 d-flex flex-column pb-3">
                                <h5 class="fw-bold p-3 text-light">Daily Quest</h5>
                                <h3 class="fw-bold px-3 py-2 text-light text-center">
                                    Complete a Course
                                </h3>
                                <div class="mt-auto text-light px-3 text-end">
                                    Reward: 50 XP
                                </div>
                            </div>
                        </div>

                        {{-- Learning Streak Card --}}
                        <div class="col-md-6 col-12 ps-3 ps-md-4 ps-lg-5 mt-4 mt-md-0">
                            <div class="card bg-pal-red border-2 rounded-4 border-dark home-card w-100 h-100">
                                <h5 class="fw-bold px-3 pt-3 m-0 text-light">Learning Streak</h5>
                                <div class="text-center px-3 mt-4">
                                    @if($streakData && $streakData['has_streak'])
                                        {{-- User has a streak --}}
                                        <span class="fw-bold text-light" style="font-size: 50px">
                                            <i class="bi bi-lightning-charge-fill"></i>
                                            <span>{{ $streakData['streak_count'] }}</span>
                                        </span>
                                        <span class="text-light fw-bold">
                                            Day{{ $streakData['streak_count'] != 1 ? 's' : '' }}
                                        </span>
                                    @elseif($streakData && !$streakData['has_streak'])
                                        {{-- User has no streak - show motivational message --}}
                                        <div class="text-light">
                                            <i class="bi bi-calendar-plus" style="font-size: 30px"></i>
                                            <p class="mt-2 small">{{ $streakData['message'] }}</p>
                                        </div>
                                    @else
                                        {{-- Fallback to original display --}}
                                        <span class="fw-bold text-light" style="font-size: 50px">
                                            <i class="bi bi-lightning-charge-fill"></i>
                                            <span>{{ $p->user_learning_streak }}</span>
                                        </span>
                                        <span class="text-light fw-bold">
                                            Day{{ $p->user_learning_streak != 1 ? 's' : '' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Continue Learning Section --}}
                    <h3 class="mt-4">Continue Learning</h3>

                    @if (count($userlessons) > 0)
                        <div class="card border-2 rounded-4 mt-3 pt-3 px-3 pb-2">
                            @foreach ($userlessons as $lesson)
                                <div class="row align-items-center mb-3">
                                    <div class="col-6">
                                        <span class="text-muted">{{ $lesson->title }}</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="text-muted">
                                            {{ round($lesson->progress * 100, 0) }}% Complete
                                        </span>
                                        <div class="progress mt-2 border border-dark rounded-5" style="min-height: 20px;">
                                            <div class="progress-bar bg-pal-red rounded-5 border border-dark"
                                                 role="progressbar"
                                                 style="width: {{ $lesson->progress * 100 }}%;"
                                                 aria-valuenow="{{ $lesson->progress * 100 }}"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h4 class="text-muted text-center mt-5">You have no lessons started yet</h4>
                    @endif

                </div>
            </div>
        </div>
    @endforeach
@endsection
