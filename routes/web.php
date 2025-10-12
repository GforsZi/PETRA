<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportsController;
use App\Http\Controllers\ManageAcoountController;
use App\Http\Controllers\ManageBookController;
use App\Http\Controllers\ManageChatbotController;
use App\Http\Controllers\ManageHistoryController;
use App\Http\Controllers\ManageRoleController;
use App\Http\Controllers\ManageTransactionController;
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
    Route::get('/admin/profile/activation', [AdminController::class, 'activation_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book', [ManageBookController::class, 'manage_book_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/{id}/pdf', [ManageBookController::class, 'pdf_book_publisher_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/{id}/detail', [ManageBookController::class, 'detail_book_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/{id}/detail/print_label', [ManageBookController::class, 'print_label_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1')->name('labels.print');
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
    Route::get('/manage/book/origin', [ManageBookController::class, 'manage_book_origin_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/origin/add', [ManageBookController::class, 'add_book_origin_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/origin/{id}/detail', [ManageBookController::class, 'detail_book_origin_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/book/origin/{id}/edit', [ManageBookController::class, 'edit_book_origin_page'])
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
    Route::get('/manage/chat/device', [ManageChatbotController::class, 'manage_device_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/chat/device/add', [ManageChatbotController::class, 'add_device_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/chat/option', [ManageChatbotController::class, 'manage_chatbot_option_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/chat/option/add', [ManageChatbotController::class, 'add_chatbot_option_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/chat/option/{id}/detail', [ManageChatbotController::class, 'detail_chatbot_option_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/chat/option/add', [ManageChatbotController::class, 'add_chatbot_option_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/chat/option/{id}/edit', [ManageChatbotController::class, 'edit_chatbot_option_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/loan', [ManageTransactionController::class, 'manage_loan_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
        Route::get('/manage/return', [ManageTransactionController::class, 'manage_return_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/transaction/{id}/detail', [ManageTransactionController::class, 'detail_transaction_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/manage/export/memberships', [ExportsController::class, 'memberships_export_page'])
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
    Route::get('/user/profile/activation', [UserController::class, 'activation_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::get('/user/profile/edit', [UserController::class, 'profile_edit_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::get('/search/book', [UserController::class, 'search_book_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::get('/search/book/{name}', [UserController::class, 'search_name_book_page'])
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
    Route::get('/transaction/{id}/edit', [UserController::class, 'edit_transaction_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::get('/transaction/{id}/detail', [UserController::class, 'detail_transaction_page'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
});

Route::middleware('auth')->group(function () {
    Route::post('/system/user/profile/edit', [UserController::class, 'edit_profile_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::post('/system/user/activation', [UserController::class, 'activation_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':0');
    Route::post('/system/admin/profile/edit', [AdminController::class, 'edit_profile_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::post('/system/admin/activation', [AdminController::class, 'activation_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1')->name('profile.activation');
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
    Route::put('/system/book/copy/{id}/edit', [ManageBookController::class, 'edit_book_copy_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::delete('/system/book/copy/{id}/delete', [ManageBookController::class, 'delete_book_copy_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::delete('/system/book/copy/delete/many', [ManageBookController::class, 'delete_many_book_copy_system'])
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
    Route::post('/system/book/{id}/add/copy', [ManageBookController::class, 'add_book_copy_system'])
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
    Route::get('/system/book', [ManageBookController::class, 'search_book_system'])
        ->middleware(CheckActivation::class . ':1')
        ->name('books.search');
    Route::get('/system/author/search', [ManageBookController::class, 'search_book_author_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1')
        ->name('authors.search');
    Route::get('/system/publisher/search', [ManageBookController::class, 'search_book_publisher_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1')
        ->name('publishers.search');
    Route::get('/system/orgin/search', [ManageBookController::class, 'search_book_orgin_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1')
        ->name('origins.search');
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
    Route::post('/system/origin/add', [ManageBookController::class, 'add_book_origin_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::put('/system/origin/{id}/edit', [ManageBookController::class, 'edit_book_origin_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::delete('/system/origin/{id}/delete', [ManageBookController::class, 'delete_book_origin_system'])
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
    Route::resource('/system/chat', ManageChatbotController::class)
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::post('/system/chat/send_message', [ManageChatbotController::class, 'send_message_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1')
        ->name('send.message');
    Route::post('/system/chat/activate', [ManageChatbotController::class, 'activate_device_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1')
        ->name('devices.activate');
    Route::post('/system/chat/disconnect', [ManageChatbotController::class, 'disconnect_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1')
        ->name('devices.disconnect');
    Route::post('/system/option/add', [ManageChatbotController::class, 'add_chatbot_option_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::put('/system/option/{id}/edit', [ManageChatbotController::class, 'edit_chatbot_option_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::delete('/system/option/{id}/delete', [ManageChatbotController::class, 'delete_chatbot_option_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::get('/system/option/chat/quick_replies', [ManageChatbotController::class, 'show_quick_reply_system'])
        ->middleware(CheckActivation::class . ':1');
    Route::post('/system/option/chat/reply', [ManageChatbotController::class, 'reply_system'])
        ->middleware(CheckActivation::class . ':1');
        Route::PUT('/system/restore/{id}', [ManageHistoryController::class, 'restore_system'])
        ->middleware(CheckActivation::class . ':1')
        ->middleware(CheckAdmin::class . ':1');
    Route::post('/system/transaction/add', [ManageTransactionController::class, 'add_transaction_system'])
        ->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':0');
    Route::put('/system/transaction/{id}/approve', [ManageTransactionController::class, 'approve_transaction_system'])
        ->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::put('/system/transaction/{id}/reject', [ManageTransactionController::class, 'reject_transaction_system'])
        ->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::delete('/system/transaction/{id}/delete', [ManageTransactionController::class, 'delete_transaction_system'])
        ->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::post('/system/print/card', [ManageAcoountController::class, 'print_card_system'])
        ->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');
    Route::post('/system/export/membership', [ExportsController::class, 'memberships_export_system'])
        ->middleware(CheckActivation::class . ':1')->middleware(CheckAdmin::class . ':1');

});

Route::get('/logout', [AuthController::class, 'logout_system'])
    ->name('logout')
    ->middleware('auth');
