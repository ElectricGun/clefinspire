@foreach ($user as $p)
<div class="sticky-bottom">
    <div class="container bg-white">
        <div class="row align-items-center py-2">
            <div class="col-4 text-start">
                <h6 class="text-muted mb-0">Lv. {{ $p->user_level }}</h6>
            </div>

            <div class="col-4">
                <div class="progress rounded-pill" style="height: 20px;">
                    <div class="progress-bar bg-pal-red" 
                         role="progressbar" 
                         style="width: {{ ($p->user_xp / 100) * 100 }}%;" 
                         aria-valuenow="{{ $p->user_xp }}" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        {{ $p->user_xp }}/100 XP
                    </div>
                </div>
            </div>

            <div class="col-4 text-end">
                <h6 class="text-muted mb-0">Lv. {{ $p->user_level + 1 }}</h6>
            </div>
        </div>
    </div>
</div>
@endforeach