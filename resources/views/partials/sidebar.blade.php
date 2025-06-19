<div class="col-auto px-0 bg-gradient-pal-red">
    <div id="sidebar" class="collapse collapse-horizontal border-end {{isset($sidebar_start_collapsed) && $sidebar_start_collapsed === true ? '' : 'show'}}">
        <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100 p-0" style="min-width: 360px">

            <div class="container">
                <div class="row d-none d-xxl-flex">
                    <div class="col text-center py-5">
                        <h2 class="text-nowrap"><span style="font-size: 100px"> <img class="img-fluid" src="/images/logo-small.png"> </span> Clefinspire </h2>
                    </div>
                </div>
            </div>

            <div style="position: fixed; top: 50vh; transform: translateY(-50%)">
                <div class="mx-5 ps-5 col border-start border-light text-light border-5 gap-5 d-flex flex-column">
                    <a class="row fs-2 text-reset text-decoration-none {{$page == 'home' ? 'fw-bold' : ''}}" href="/home">
                        Home
                    </a>

                    <a class="row fs-2 text-reset text-decoration-none {{$page == 'eartraining' ? 'fw-bold' : ''}}" href="/courses/eartraining">
                        Ear Training
                    </a>

                    <a class="row fs-2 text-reset text-decoration-none {{$page == 'musictheory' ? 'fw-bold' : ''}}" href="/courses/musictheory">
                        Music Theory
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
