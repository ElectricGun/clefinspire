<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ClefinspireAuth;
use App\Providers\UserProfileProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');

        $terms = preg_split('/(?=(?:\s|^)user:|(?:\s|^)course:)|\|/', $query);

        $user_terms = [];
        $course_terms = [];

        foreach ($terms as $term) {
            $search_term = trim(preg_replace('/(\s|^)user:|(\s|^)course:/', "", $term));
            $filter_term = trim(preg_replace('/' . $search_term . '/', "", $term));

            switch ($filter_term) {
                default:
                    array_push($user_terms, $search_term);
                    array_push($course_terms, $search_term);
                    break;
                case "user:":
                    array_push($user_terms, $search_term);
                    break;
                case "course:":
                    array_push($course_terms, $search_term);
                    break;
            }
        }

        $user_terms =  array_filter(array_unique($user_terms), 'strlen');
        $course_terms = array_filter(array_unique($course_terms), 'strlen');

        $users_get = null;
        $courses_get = null;

        $both_zero = (count($user_terms) == 0 && count($course_terms) == 0);

        if (count($user_terms) > 0 || $both_zero) {
            $users_get = DB::table('Account', 'a')
                ->join('User as u', 'a.id', '=', 'u.account_id')
                ->join('DisplayProfile as dp', 'dp.user_id', '=', 'u.user_id')
                ->where('a.name', 'REGEXP', implode("|", $user_terms))
                ->orwhere('dp.display_name', 'REGEXP', implode("|", $user_terms))
                ->get([
                    'a.name',
                    'u.user_level',
                    'dp.display_name',
                    'a.id',
                    'dp.profile_picture'
                ]);
        }

        if (count($course_terms) > 0 || $both_zero) {
            $courses_get = DB::table('Course', 'c')
                ->where('c.course_name', 'REGEXP', implode("|", $course_terms))
                ->get();
        }

        $user = ClefinspireAuth::get_user();
        $display_profile = UserProfileProvider::get_user_profile($user->last()->user_id);
        return view('search', ['query' => $query, 'user' => $user, 'users_get' => $users_get, 'display_profile' => $display_profile, 'courses_get' => $courses_get]);
    }
}
