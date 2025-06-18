<style>
    .no-outline:focus {
        border-style: none !important;
    }
</style>

<div class="sticky-xxl-top">
    <div class="container bg-white">
        <div class="row d-flex justify-content-between pt-4">
            <div class="{{!(isset($search_enabled) && $search_enabled === false) ? 'col-4' : 'col-8'}}">
                @yield('pagetitle')

                @if(isset($pagetitle) && !(isset($disable_default_title) && $disable_default_title === true))
                <h2>{{$pagetitle}}</h2>
                @endif
            </div>

            @if (!(isset($search_enabled) && $search_enabled === false))
                <div class="col-md-4 col-md-4 py-4 px-0 d-none d-md-block">
                    @include('partials.searchbar')
                </div>
            @endif


            <div class="col-8 col-md-4">
                <a href="/userprofile" class="text-decoration-none text-dark">
                    <div class="row d-flex justify-content-end align-items-center">
                        <div class="col-7 text-end" style="direction: rtl">
                            <h4>Beginner</h4>
                            <h5 class="text-muted">Level&nbsp;{{ $user->user_level }}</h5>
                        </div>
                        <div class="col-auto align-items-center d-none d-xl-flex">
                            <div class="card rounded-circle overflow-hidden" style="width: 75px; height: 75px;">
                                <img src="{{ asset('storage/' . (isset($display_profile) ? $display_profile->profile_picture : '#')) }}"
                                    onerror="this.src='/images/blank_profile.png'" alt="Profile Picture"
                                    class="img-fluid w-100 h-100 object-fit-cover" alt="Profile image">
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>



        <div class="row d-flex justify-content-center d-block d-md-none">
            <div class="col-6 py-4 px-0">
                @include('partials.searchbar')
            </div>
        </div>

        <hr class="mt-2 border-3">
    </div>
</div>
