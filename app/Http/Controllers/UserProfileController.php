<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function show(Request $request)
    {

        $user_id_query = $request->get('user_id');
        $user_id = $user_id_query;

        $user = Auth::user();

        if ($user_id_query !== null) {
            $user = DB::table('Account')
            ->where('id', '=', $user_id)
            ->first();
        }

        if (!$user) {
            return view('userprofile', ['user' => null]);
        }

        $profileData = DB::table('Account')
            ->where('Account.id', $user->id)
            ->leftJoin('User', 'User.account_id', '=', 'Account.id')
            ->leftJoin('DisplayProfile', 'DisplayProfile.user_id', '=', 'User.user_id')
            ->select(
                'Account.name',
                'Account.email',
                'Account.id',
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
            'user_id_query' => $user_id_query
            // dont return original user, kinda unsafe
            // 'originalUser' => $user
        ]);
    }
}
