<?php

use App\Http\Controllers\FollowersController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UsersController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [StaticPagesController::class, 'home'])->name('home');
Route::get('/help', [StaticPagesController::class, 'help'])->name('help');
Route::get('/about', [StaticPagesController::class, 'about'])->name('about');

Route::get('signup', [UsersController::class,'create'])->name('signup');

//follower and following
Route::get('users/{user}/followings',[UsersController::class,'followings'])->name('users.followings');
Route::get('users/{user}/followers',[UsersController::class,'followers'])->name('users.followers');
Route::post('users/followers/{user}',[FollowersController::class,'store'])->name('followers.store');
Route::delete('users/followers/{user}',[FollowersController::class,'destroy'])->name('followers.destroy');

Route::get('signup/confirm/{token}',[UsersController::class,'confirmEmail'])->name('confirm_email');
Route::resource('users',UsersController::class);

//Session
Route::get('login', [SessionsController::class,'create'])->name('login');
Route::post('login', [SessionsController::class,'store'])->name('login');
Route::delete('logout', [SessionsController::class,'destroy'])->name('logout');

//weibo
Route::resource('status', StatusController::class)->only('index','create','store','destroy');
//Password
//send
Route::get('password/reset', [PasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [PasswordController::class,'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [PasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [PasswordController::class,'reset'])->name('password.update');

//user handle

