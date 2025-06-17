<?php

// File: app/Http/Controllers/UserProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    // Menampilkan halaman profil pengguna
    public function show(Request $request)
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Mengambil data profil pengguna
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
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'display_name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update nama dan bio
        DB::table('DisplayProfile')
            ->where('user_id', $user->id)
            ->update([
                'display_name' => $validated['display_name'],
                'bio' => $validated['bio'],
            ]);

        // Jika ada gambar profil yang di-upload
        if ($request->hasFile('profile_picture')) {
            // Menentukan path penyimpanan dengan folder berdasarkan account_id dan user_id
            $accountId = $account->id;
            $imagePath = $request->file('profile_picture')->store("accounts/$accountId/users/$userId/assets", 'public');

            // Update gambar profil di tabel DisplayProfile
            DB::table('DisplayProfile')
                ->where('user_id', $user->id)
                ->update(['profile_picture' => $imagePath]);
        }

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('userprofile')->with('success', 'Profile updated successfully');
    }
}


