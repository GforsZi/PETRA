<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManageAcoountController;
use App\Http\Controllers\ManageBookController;
use App\Http\Controllers\ManageRoleController;
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
    Route::get('/admin/profile/edit', [AdminController::class, 'profile_edit_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book', [ManageBookController::class, 'manage_book_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/{id}/detail', [ManageBookController::class, 'detail_book_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/add', [ManageBookController::class, 'add_book_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/{id}/edit', [ManageBookController::class, 'edit_book_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/ddc', [ManageBookController::class, 'manage_book_classfication_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/ddc/add', [ManageBookController::class, 'add_book_classfication_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/ddc/{id}/edit', [ManageBookController::class, 'edit_book_classfication_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/author', [ManageBookController::class, 'manage_book_author_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/author/{id}/detail', [ManageBookController::class, 'detail_book_author_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/author/add', [ManageBookController::class, 'add_book_author_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/author/{id}/edit', [ManageBookController::class, 'edit_book_author_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/publisher', [ManageBookController::class, 'manage_book_publisher_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/publisher/add', [ManageBookController::class, 'add_book_publisher_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/publisher/{id}/edit', [ManageBookController::class, 'edit_book_publisher_pageS'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/account', [ManageAcoountController::class, 'manage_account_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/account/{id}/detail', [ManageAcoountController::class, 'detail_account_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/account/add', [ManageAcoountController::class, 'add_account_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/account/{id}/edit', [ManageAcoountController::class, 'edit_account_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/role', [ManageRoleController::class, 'manage_role_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/role/add', [ManageRoleController::class, 'add_role_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/role/{id}/edit', [ManageRoleController::class, 'edit_role_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [UserController::class, 'home_page'])->name('home')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':0');
    Route::get('/user/profile', [UserController::class, 'profile_page'])->name('user_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':0');
});

Route::get('/logout', [AuthController::class, 'logout_system'])->name('logout')->middleware('auth');
