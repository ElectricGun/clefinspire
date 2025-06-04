<style>
    .no-outline:focus{
        border-style: none !important;
    }
</style>

@foreach($user as $p)

<div class="container"> 
    <div class="row mt-4 d-flex justify-content-between">
        <div class="col-4">
            <h2>Home</h2>
        </div>
        <div class="col-3 py-4 px-0">
            <div class="input-group">
                <i class="bi bi-search"></i>
                <input type="email" class="form-control border-0 border-5 rounded-0 py-0 shadow-none" id="search" placeholder="Search">
            </div>
            <hr class="mt-1 border-3">
        </div>
        <div class="col-4">
            <div class="row d-flex justify-content-end">
                <div class = "col-7 text-end">
                    <h4>Beginner</h4>
                    <h5 class="text-muted"> Level {{$p->user_level}}</h5>
                </div>
                <div class="col-5 d-flex align-items-center">
                    <div class="card ratio ratio-1x1 rounded-circle overflow-hidden" style="max-height: 75px; max-width: 75px;">
                      <img 
                        src="https://picsum.photos/200" 
                        class="img-fluid w-100 h-100 object-fit-cover" 
                        alt="Profile image">
                    </div>
                  </div>                  
            </div>
        </div>
    </div>

    <hr class="mt-2 border-3">
</div>

@endforeach