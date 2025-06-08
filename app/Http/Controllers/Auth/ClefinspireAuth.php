<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClefinspireAuth extends Controller {

    public static function get_user() {
        $logged_in_user = Auth::user();

        if ($logged_in_user == null) {
            return redirect('/');
        }

        $account_id = $logged_in_user->id;
        

        $user = DB::table('users')
            ->where('users.id', '=', $account_id)
            ->join('User', 'User.account_id', '=', 'users.id')
            ->join('DisplayProfile', 'DisplayProfile.user_id', '=', 'User.user_id')
            ->select('users.*', 'User.*', 'DisplayProfile.*')
            ->get();
        
        return $user;
    }

}