<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Streak extends Model
{
    public static function checkHasStreak($userId)
    {
        $user = DB::table('User')->where('user_id', $userId)->first();
        
        if (!$user) {
            return false;
        }
        
        return $user->user_learning_streak > 0;
    }
    
    public static function getUserStreak($userId)
    {
        $user = DB::table('User')->where('user_id', $userId)->first();
        return $user ? $user->user_learning_streak : 0;
    }
    
    public static function getMotivationalMessage()
    {
        return "Start your learning journey today!";
    }
}