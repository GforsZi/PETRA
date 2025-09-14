<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home_page() {
        return view('user.home', ['title' => 'Halaman Home']);
    }

    public function profile_page() {
        return view('user.profile', ['title' => 'Halaman Profile']);
    }

    public function search_book_page() {
        return view('user.book.search', ['title' => 'Halaman Cari Buku']);
    }

    public function detail_book_page($id) {
        return view('user.book.detail', ['title' => 'Halaman Detail Buku']);
    }

}
