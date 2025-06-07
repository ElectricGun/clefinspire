<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SigninController;


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

<<<<<<< HEAD
Route::get('/', [HomeController::class, 'show']);

Route::get('/home', [HomeController::class, 'show']);
Route::get('/signin', [SigninController::class, 'show'])->name('signin');
Route::post('/signin', [SigninController::class, 'submit'])->name('signin.submit');
=======
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/signup', [App\Http\Controllers\SignupController::class, 'index']);
>>>>>>> EM
