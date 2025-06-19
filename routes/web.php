<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SigninController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CoursePageController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'show']);
Route::get('/landing', [LandingController::class, 'show']);
Route::get('/home', [HomeController::class, 'show']);

Route::get('/signin', [SigninController::class, 'show']);
Route::post('/signin/post', [SigninController::class, 'submit']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register/post', [RegisterController::class, 'submit']);

Route::get('/userprofile', [UserProfileController::class, 'show'])->name('userprofile');
Route::post('/userprofile/update', [UserProfileController::class, 'update'])->name('profile.update');
Route::delete('/userprofile/delete', [UserProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/courses/musictheory', [CoursesController::class, 'show_music_theory']);
Route::get('/courses/eartraining', [CoursesController::class, 'show_ear_training']);

Route::get('/search', [SearchController::class, 'search']);

Route::get('/courses/musictheory/{courseid}', [CoursePageController::class, 'show_music_theory']);
Route::get('/courses/eartraining/{courseid}', [CoursePageController::class, 'show_ear_training']);

Route::get('/courses/musictheory/{courseid}/{lessonid}', [LessonController::class, 'show_music_theory']);
Route::get('/courses/eartraining/{courseid}/{lessonid}', [LessonController::class, 'show_ear_training']);

Route::get('/courses/musictheory/{courseid}/{lessonid}/{taskid}', [TaskController::class, 'show_music_theory']);
Route::get('/courses/eartraining/{courseid}/{lessonid}/{taskid}', [TaskController::class, 'show_ear_training']);