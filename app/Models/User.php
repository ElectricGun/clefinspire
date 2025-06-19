<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'Account';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function create($name, $email, $password): User {
        $user = new User();
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->name = $name;

        return $user;
    }

    public static function create_display_data($account_id): void {
        DB::table('User')->insert([
            'account_id' => $account_id
        ]);

        $user_profile = DB::table('User')->where('account_id', '=', $account_id)->get();

        foreach ($user_profile as $up) {
            DB::table('DisplayProfile')->insert([
                'user_id' => $up->user_id
            ]);
        }
    }
}
