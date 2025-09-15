<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home_page() {
        $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
        return view('user.home', ['title' => 'Halaman Home'], compact('user'));
    }

    public function profile_page() {
        $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
        return view('user.profile', ['title' => 'Halaman Profile'], compact('user'));
    }

    public function search_book_page() {
        return view('user.book.search', ['title' => 'Halaman Cari Buku']);
    }

    public function detail_book_page($id) {
        return view('user.book.detail', ['title' => 'Halaman Detail Buku']);
    }

}
