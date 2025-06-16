<?php

namespace App\Providers;

use App\Http\Controllers\Auth\ClefinspireAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class UserProfileProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public static function get_user_profile($user_id) {

        $display_profile = DB::table('User', 'u')
        ->join('DisplayProfile', 'DisplayProfile.user_id', '=', 'u.user_id')
        ->where('u.account_id', '=', $user_id)
        ->get()->last();

        return $display_profile;
    }
}
