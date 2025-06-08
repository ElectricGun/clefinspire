<style>
    .no-outline:focus {
        border-style: none !important;
    }
</style>

@foreach ($user as $p)
    <div class="container">
        <div class="row mt-4 d-flex justify-content-between">
            <div class="col-4">
                <h2>{{isset($pagetitle) ? $pagetitle : '<ERR PAGE NAME UNSET>'}}</h2>
            </div>

            <div class="col-md-4 col-md-4 py-4 px-0 d-none d-md-block">
                @include('partials.searchbar')
            </div>

            <div class="col-8 col-md-4">
                <div class="row d-flex justify-content-end">
                    <div class = "col-7 text-end">
                        <h4>Beginner</h4>
                        <h5 class="text-muted"> Level {{ $p->user_level }}</h5>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                        <div class="card rounded-circle overflow-hidden" style="width: 75px; height: 75px;">
                            <img src="https://picsum.photos/200" class="img-fluid w-100 h-100 object-fit-cover" alt="Profile image">
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row d-flex justify-content-center d-block d-md-none">
            <div class="col-6 py-4 px-0">
                @include('partials.searchbar')
            </div>
        </div>

        <hr class="mt-2 border-3">
    </div>
@endforeach
