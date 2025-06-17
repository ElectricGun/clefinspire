<?php

// File: app/Http/Controllers/UserProfileController.php

namespace App\Http\Controllers;

use App\Providers\UserProfileProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    // Menampilkan halaman profil pengguna
    public function show(Request $request)
    {

        $user_id = $request->get('user_id');

        if ($user_id === null) {
            $user_id = Auth::user()->id;
        }

        // Mengambil data profil pengguna
        $profileData = DB::table('Account')
            ->where('Account.id', $user_id)
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

        // Mengambil badges jika ada
        $badges = DB::table('UserBadge')
            ->where('user_id', $profileData->user_id ?? null)
            ->join('Badges', 'Badges.badge_id', '=', 'UserBadge.badge_id')
            ->select('Badges.*', 'UserBadge.time_acquired')
            ->orderBy('UserBadge.time_acquired', 'desc')
            ->get();
        
        return view('userprofile', [
            'user' => $profileData,
            'badges' => $badges
        ]);
    }

    // Memperbarui profil pengguna (nama, bio, gambar profil)
    public function update(Request $request)
    {
        $account = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'display_name' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $accountId = $account->id;
        $userId = DB::table('User', 'u')
            ->where('u.account_id', '=', $accountId)
            ->get()
            ->last()->user_id;

        // Update nama dan bio
        DB::table('DisplayProfile')
            ->where('user_id', $userId)
            ->update([
                'display_name' => $validated['display_name'],
                'bio' => $validated['bio'],
            ]);

        // Jika ada gambar profil yang di-upload
        if ($request->hasFile('profile_picture')) {
            // Menentukan path penyimpanan dengan folder berdasarkan account_id dan user_id

            $imagePath = $request->file('profile_picture')->store("accounts/$accountId/users/$userId/assets", 'public');

            // Update gambar profil di tabel DisplayProfile
            DB::table('DisplayProfile')
                ->where('user_id', $userId)
                ->update(['profile_picture' => $imagePath]);
        }

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('userprofile')->with('success', 'Profile updated successfully');
    }
}
