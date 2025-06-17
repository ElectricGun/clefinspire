<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClefinspireAuth extends Controller {

    public static function get_user() {
        $logged_in_user = Auth::user();

        if ($logged_in_user == null) {
            return null;
        }

        $account_id = $logged_in_user->id;
        

        $user = DB::table('Account')
            ->where('Account.id', '=', $account_id)
            ->join('User', 'User.account_id', '=', 'Account.id')
            ->join('DisplayProfile', 'DisplayProfile.user_id', '=', 'User.user_id')
            ->select('Account.*', 'User.*', 'DisplayProfile.*')
            ->get()->last();
        
        return $user;
    }

}