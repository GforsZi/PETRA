<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckActivation;
use App\Http\Middleware\CheckAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['title' => 'Halaman Landing']);
});
Route::get('/forbidden', function () {
    $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
    return view('forbidden', ['title' => 'Forbidden page', 'users' => $user]);
})->middleware(CheckActivation::class . ':0');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login_page'])->name('login');
    Route::get('/register', [AuthController::class, 'register_page'])->name('register');
    Route::post('/system/login', [AuthController::class, 'login_system']);
    Route::post('/system/register', [AuthController::class, 'register_system']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard_page'])->name('dashboard')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/admin/profile', [AdminController::class, 'profile_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [UserController::class, 'home_page'])->name('home')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':0');
    Route::get('/user/profile', [UserController::class, 'profile_page'])->name('user_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':0');
});
