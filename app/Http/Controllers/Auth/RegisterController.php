<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        return view('auth/register');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        $email_check = DB::table('Account')->where('Account.email', '=', $request->email)->get();
        $name_check = DB::table('Account')->where('Account.name', '=', $request->name)->get();

        if (sizeof($email_check) > 0) {
            return back()->withErrors([
                'email' => 'Email is already in use'
            ])->withInput();
        }

        if (sizeof($name_check) > 0) {
            return back()->withErrors([
                'name' => 'Username is taken'
            ])->withInput();
        }

        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        if (Auth::attempt($validated)) {

            DB::table('User')->insert([
                'account_id' => Auth::user()->id
            ]);

            $user_profile = DB::table('User')->where('account_id', '=', Auth::user()->id)->get();

            foreach ($user_profile as $up) {
                DB::table('DisplayProfile')->insert([
                    'user_id' => $up->user_id
                ]);
            }

            $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        return back()->withInput();
    }
}
