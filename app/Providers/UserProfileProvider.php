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

    public static function get_user_profile($account_id) {

        $display_profile = DB::table('User', 'u')
        ->join('DisplayProfile', 'DisplayProfile.user_id', '=', 'u.user_id')
        ->where('u.account_id', '=', $account_id)
        ->get()->last();

        return $display_profile;
    }

    public static function calculate_level($user_xp) {
        return floor($user_xp / 100);
    }

    public static function calculate_skill($level) {
        return match (true) {
            $level <= 9 => 'Beginner',
            $level <= 34 => 'Intermediate',
            $level <= 99 => 'Advanced',
            $level >= 100 => 'Virtuoso'
        };
    }
}
