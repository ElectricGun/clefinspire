@php
    use App\Providers\UserProfileProvider;
@endphp

@extends('layouts.main', ['page' => 'search'])

@section('title')
    Clefinspire - Search: {{ $query }}
@endsection





@section('content')
    @include('partials.navbar', [
        'user' => $user,
        'pagetitle' => 'Search',
        'query' => $query,
        'display_profile' => $display_profile,
    ])

    <div class="container">
        <div class="row d-flex justify-content-center mt-3 align-items-stretch">
            <div class="col-12 col-md-10 col-lg-8">

                @if (($courses_get !== null && count($courses_get) > 0) || ($users_get !== null && count($users_get) > 0))
                    @if ($courses_get !== null)
                        @foreach ($courses_get as $c)
                            <a class="card border-2 rounded-4 mt-3 pt-3 px-3 pb-2 text-decoration-none"
                                href="/courses/{{ $c->course_type }}/{{ $c->course_id }}">
                                <div class="row align-items-top mb-3">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col overflow-hidden">
                                                <span class="h2">
                                                    {{ $c->course_name }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-6 text-end">
                                        <h3 class="mb-0">
                                            {{ match (true) {
                                                $c->difficulty <= 49 => 'Beginner',
                                                $c->difficulty <= 99 => 'Intermediate',
                                                $c->difficulty >= 100 => 'Advanced',
                                            } }}
                                            </h1>
                                            <h5 class="text-muted"> Course </h5>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif

                    @if ($users_get !== null)
                        @foreach ($users_get as $u)
                            <a class="card border-2 rounded-4 mt-3 pt-3 px-3 pb-2 text-decoration-none"
                                href="/userprofile/?user_id={{ $u->id }}">
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-auto d-flex align-items-top">
                                                <div class="card rounded-circle overflow-hidden"
                                                    style="width: 75px; height: 75px;">
                                                    <img src="{{ asset('storage/' . (isset($u) ? $u->profile_picture : '#')) }}"
                                                        onerror="this.src='/images/blank_profile.png'" alt="Profile Picture"
                                                        class="img-fluid w-100 h-100 object-fit-cover" alt="Profile image">
                                                </div>
                                            </div>

                                            <div class="col overflow-hidden">
                                                <div class="h2 mb-0">
                                                    {{ $u->display_name !== null ? $u->display_name : '@' . $u->name }}
                                                </div>
                                                @if ($u->display_name !== null)
                                                    <div class="h5 text-muted">
                                                        {{ '@' . $u->name }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-6 text-end border-3 border-start">
                                        <h3 class="mb-0 text-dark">
                                            {{ UserProfileProvider::calculate_skill(UserProfileProvider::calculate_level($u->user_xp)) }}
                                        </h3>
                                        <h5 class="text-muted">Level
                                            {{ UserProfileProvider::calculate_level($u->user_xp) }}
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                @else
                    <div class="d-flex justify-content-center align-items-center" style="height: 60vh">
                        <h1> No Results Found </h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
