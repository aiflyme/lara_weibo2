<?php

use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StaticPagesController;
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

Route::get('signup/confirm/{token}',[UsersController::class,'confirmEmail'])->name('confirm_email');
Route::resource('users',UsersController::class);

//Session
Route::get('login', [SessionsController::class,'create'])->name('login');
Route::post('login', [SessionsController::class,'store'])->name('login');
Route::delete('logout', [SessionsController::class,'destroy'])->name('logout');


