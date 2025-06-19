@php
    use App\Providers\UserProfileProvider;
@endphp

@extends('layouts.main', ['page' => 'sus'])

@section('title')
    Clefinspire - User: {{ $user->name }}
@endsection

@section('content')

    <body>

        <!-- Header Section -->
        <div class="header d-flex justify-content-between align-items-center p-3 bg-white shadow-sm mb-4 position-relative">
            <div class="logo d-flex align-items-center">
                <span class="fs-4 me-2">&#119070;</span>
                <span class="fs-4">Clefinspire</span>
            </div>
            <div class="fs-5 position-absolute start-50 translate-middle-x">User Profile</div>
            <div style="width: 100px;"></div>
        </div>

        <!-- Menampilkan pesan sukses dengan tanda silang untuk menutup -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($user !== null)
            <!-- Profile Section -->
            <div class="profile-section text-center">

                <h2 class="mb-1">{{ $user->display_name ?? '@' . $user->name }}</h2>
                <h5 class="mb-3 text-muted">{{ $user->display_name !== null ? '@' . $user->name : '' }}</h5>

                <div class="d-flex justify-content-center align-items-center mb-3 position-relative">
                    @if ($badges->count() > 0)
                        <div class="position-absolute d-flex flex-column align-items-center"
                            style="left: calc(50% - 230px); transform: translateX(-50%);">
                            <div class="rounded-circle bg-secondary mb-2 d-flex align-items-center justify-content-center"
                                style="width: 70px; height: 70px;" title="{{ $badges[0]->badge_desc }}">
                                <i class="bi bi-award-fill text-white"></i>
                            </div>
                            <span class="text-muted small">{{ $badges[0]->badge_name }}</span>
                        </div>
                    @endif

                    <div class="avatar">
                        <img src="{{ asset('storage/' . $user->profile_picture) }}"
                            onerror="this.src='/images/blank_profile.png'" alt="Profile Picture"
                            class="rounded-circle border border-3 border-dark"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    @if ($badges->count() > 1)
                        <div class="position-absolute d-flex flex-column align-items-center"
                            style="right: calc(50% - 230px); transform: translateX(50%);">
                            <div class="rounded-circle bg-secondary mb-2 d-flex align-items-center justify-content-center"
                                style="width: 70px; height: 70px;" title="{{ $badges[1]->badge_desc }}">
                                <i class="bi bi-award-fill text-white"></i>
                            </div>
                            <span class="text-muted small">{{ $badges[1]->badge_name }}</span>
                        </div>
                    @endif
                </div>

                <h4>{{ UserProfileProvider::calculate_skill(UserProfileProvider::calculate_level($user->user_xp)) }}</h4>
                <h5 class="mb-4 text-muted">Level&nbsp;{{ UserProfileProvider::calculate_level($user->user_xp) }}</h5>


                @if ($user->bio ?? false)
                    <div class="row d-flex justify-content-center">
                        <p class="col-4 py-3 text-muted mb-4 mt-3 card border-1">{{ $user->bio }}</p>
                    </div>
                @endif



            </div>

            <hr class="mt-3 mb-4">

            @if ($user->id == Auth::user()->id)
                <!-- Menu Section -->
                <div class="menu mx-auto" style="max-width: 500px;">
                    <a href="#" class="text-decoration-none text-dark">
                        <div
                            class="d-flex justify-content-between align-items-center p-3 border border-1 border-danger rounded mb-4 hover-bg-light">
                            <span>Personal Information</span>
                            <i class="bi bi-chevron-right text-danger"></i>
                        </div>
                    </a>

                    <a href="#" class="text-decoration-none text-dark" data-bs-toggle="modal"
                        data-bs-target="#customizeModal">
                        <div
                            class="d-flex justify-content-between align-items-center p-3 border border-1 border-danger rounded mb-4 hover-bg-light">
                            <span>Customize</span>
                            <i class="bi bi-chevron-right text-danger"></i>
                        </div>
                    </a>

                    <!-- Logout Button -->
                    <a href="#" onclick="confirmLogout()" class="text-decoration-none text-dark">
                        <div
                            class="d-flex justify-content-between align-items-center p-3 border border-1 border-danger rounded mb-4 hover-bg-light">
                            <span>
                                Logout
                            </span>
                            <i class="bi bi-chevron-right text-danger"></i>
                        </div>
                    </a>
                </div>

                <!-- Logout Confirmation Form -->
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="mb-0" style="display: none;">
                    @csrf
                    <button type="submit" id="logoutSubmit"></button>
                </form>

                <script>
                    function confirmLogout() {
                        if (confirm("Do you want to log out?")) {
                            document.getElementById("logoutForm").submit();
                        }
                    }
                </script>
            @endif
        @else
            <div class="d-flex justify-content-center align-items-center" style="height: 60vh">
                <h1> User Not Found </h1>
            </div>
        @endif

        <!-- Modal Customize -->
        <div class="modal fade" id="customizeModal" tabindex="-1" aria-labelledby="customizeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="customizeModalLabel">Customize Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk mengupdate profil -->
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                            </div>

                            <div class="mb-3">
                                <label for="display_name" class="form-label">Display Name</label>
                                <input type="text" class="form-control" id="display_name" name="display_name"
                                    value="{{ old('display_name', $user->display_name) }}">
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Save Profile</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    </body>

@endsection
