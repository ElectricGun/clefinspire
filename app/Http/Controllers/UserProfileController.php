<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function show()
    {
    $user = Auth::user();
    
    if (!$user) {
        return redirect('/');
    }

    $profileData = DB::table('users')
        ->where('users.id', $user->id)
        ->leftJoin('User', 'User.account_id', '=', 'users.id')
        ->leftJoin('DisplayProfile', 'DisplayProfile.user_id', '=', 'User.user_id')
        ->select(
            'users.name',
            'users.email',
            'User.user_id',
            'User.user_learning_streak',
            'User.user_xp',
            'User.user_level',
            'DisplayProfile.display_name',
            'DisplayProfile.bio',
            'DisplayProfile.profile_picture',
            'DisplayProfile.status'
        )
        ->first();

    $badges = DB::table('UserBadge')
        ->where('user_id', $profileData->user_id ?? null)
        ->join('Badges', 'Badges.badge_id', '=', 'UserBadge.badge_id')
        ->select('Badges.*', 'UserBadge.time_acquired')
        ->orderBy('UserBadge.time_acquired', 'desc')
        ->get();

    return view('userprofile', [
        'user' => $profileData,
        'badges' => $badges,
        'originalUser' => $user
    ]);
    }
}