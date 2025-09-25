<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManageAcoountController;
use App\Http\Controllers\ManageBookController;
use App\Http\Controllers\ManageHistoryController;
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
    $user = User::where('usr_id', Auth::user()->usr_id)
        ->with('roles')
        ->get()
        ->first();
    return view('forbidden', ['title' => 'Forbidden page', 'users' => $user]);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login_page'])->name('login');
    Route::get('/register', [AuthController::class, 'register_page'])->name('register');
    Route::post('/system/login', [AuthController::class, 'login_system']);
    Route::post('/system/register', [AuthController::class, 'register_system']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/admin/profile', [AdminController::class, 'profile_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/admin/profile/edit', [AdminController::class, 'profile_edit_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book', [ManageBookController::class, 'manage_book_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/{id}/detail', [ManageBookController::class, 'detail_book_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/add', [ManageBookController::class, 'add_book_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/{id}/edit', [ManageBookController::class, 'edit_book_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/major', [ManageBookController::class, 'manage_book_major_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/major/{id}/detail', [ManageBookController::class, 'detail_book_major_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/major/add', [ManageBookController::class, 'add_book_major_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/major/{id}/edit', [ManageBookController::class, 'edit_book_major_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/ddc', [ManageBookController::class, 'manage_book_classfication_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/ddc/add', [ManageBookController::class, 'add_book_classfication_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/ddc/{id}/detail', [ManageBookController::class, 'detail_book_classfication_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/ddc/{id}/edit', [ManageBookController::class, 'edit_book_classfication_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/author', [ManageBookController::class, 'manage_book_author_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/author/{id}/detail', [ManageBookController::class, 'detail_book_author_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/author/add', [ManageBookController::class, 'add_book_author_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/author/{id}/edit', [ManageBookController::class, 'edit_book_author_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/publisher', [ManageBookController::class, 'manage_book_publisher_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/publisher/add', [ManageBookController::class, 'add_book_publisher_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/publisher/{id}/edit', [ManageBookController::class, 'edit_book_publisher_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/publisher/{id}/detail', [ManageBookController::class, 'detail_book_publisher_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/account', [ManageAcoountController::class, 'manage_account_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/account/{id}/detail', [ManageAcoountController::class, 'detail_account_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/account/add', [ManageAcoountController::class, 'add_account_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/account/{id}/edit', [ManageAcoountController::class, 'edit_account_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/role', [ManageRoleController::class, 'manage_role_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/role/add', [ManageRoleController::class, 'add_role_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/role/{id}/detail', [ManageRoleController::class, 'detail_role_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/role/{id}/edit', [ManageRoleController::class, 'edit_role_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/history', [ManageHistoryController::class, 'manage_history_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [UserController::class, 'home_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::get('/user/profile', [UserController::class, 'profile_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::get('/search/book', [UserController::class, 'search_book_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::get('/search/book/{id}/detail', [UserController::class, 'detail_book_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::get('/transaction', [UserController::class, 'view_transaction_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::get('/transaction/add', [UserController::class, 'add_transaction_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::get('/transaction/{$id}/edit', [UserController::class, 'edit_transaction_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::get('/transaction/{$id}/detail', [UserController::class, 'detail_transaction_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
});

Route::middleware('auth')->group(function () {
    Route::post('/system/account/add', [ManageAcoountController::class, 'add_account_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::put('/system/account/{id}/edit', [ManageAcoountController::class, 'edit_account_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::put('/system/account/{id}/ban', [ManageAcoountController::class, 'banned_account_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::put('/system/account/{id}/activate', [ManageAcoountController::class, 'activated_account_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::delete('/system/account/{id}/delete', [ManageAcoountController::class, 'delete_account_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::post('/system/role/add', [ManageRoleController::class, 'add_role_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::put('/system/role/{id}/edit', [ManageRoleController::class, 'edit_role_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::delete('/system/role/{id}/delete', [ManageRoleController::class, 'delete_role_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::post('/system/book/add', [ManageBookController::class, 'add_book_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::put('/system/book/{id}/edit', [ManageBookController::class, 'edit_book_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::delete('/system/book/{id}/delete', [ManageBookController::class, 'delete_book_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::post('/system/major/add', [ManageBookController::class, 'add_book_major_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::put('/system/major/{id}/edit', [ManageBookController::class, 'edit_book_major_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::delete('/system/major/{id}/delete', [ManageBookController::class, 'delete_book_major_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/system/author/search', [ManageBookController::class, 'search_book_author_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1')
        ->name('authors.search');
    Route::get('/system/publisher/search', [ManageBookController::class, 'search_book_publisher_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1')
        ->name('publishers.search');
    Route::get('/system/ddc/search', [ManageBookController::class, 'search_book_ddc_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1')
        ->name('ddc.search');
    Route::post('/system/author/add', [ManageBookController::class, 'add_book_author_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::put('/system/author/{id}/edit', [ManageBookController::class, 'edit_book_author_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::delete('/system/author/{id}/delete', [ManageBookController::class, 'delete_book_author_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::post('/system/publisher/add', [ManageBookController::class, 'add_book_publisher_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::put('/system/publisher/{id}/edit', [ManageBookController::class, 'edit_book_publisher_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::delete('/system/publisher/{id}/delete', [ManageBookController::class, 'delete_book_publisher_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::post('/system/ddc/add', [ManageBookController::class, 'add_book_classfication_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::put('/system/ddc/{id}/edit', [ManageBookController::class, 'edit_book_classfication_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::delete('/system/ddc/{id}/delete', [ManageBookController::class, 'delete_book_classfication_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
});

Route::get('/logout', [AuthController::class, 'logout_system'])
    ->name('logout')
    ->middleware('auth');
