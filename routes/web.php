<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SigninController;
use App\Http\Controllers\HomeController;
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
Route::get('/home', [HomeController::class, 'show']);

Route::get('/signin', [SigninController::class, 'show'])->name('signin');
Route::post('/signin', [SigninController::class, 'submit'])->name('signin.submit');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'submit'])->name('register.submit');

