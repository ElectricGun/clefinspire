@php
    use App\Providers\UserProfileProvider;
@endphp

<div class="sticky-xxl-bottom">
    <div class="container bg-white">
        <div class="row align-items-center py-2">
            <div class="col-4 text-start">
                <h6 class="text-muted mb-0">Lv. {{ UserProfileProvider::calculate_level($user->user_xp) }}</h6>
            </div>
            
            <div class="col-4">
                <div class="progress rounded-pill" style="height: 20px;">
                    <div class="progress-bar bg-pal-red" 
                         role="progressbar" 
                         style="width: {{ ($user->user_xp / 100) * 100 }}%;" 
                         aria-valuenow="{{ $user->user_xp }}" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        {{ $user->user_xp }}/100 XP
                    </div>
                </div>
            </div>

            <div class="col-4 text-end">
                <h6 class="text-muted mb-0">Lv. {{ UserProfileProvider::calculate_level($user->user_xp) + 1 }}</h6>
            </div>
        </div>
    </div>
</div>
