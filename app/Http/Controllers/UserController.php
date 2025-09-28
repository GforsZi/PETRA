<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home_page()
    {
        $book_new = Book::select('bk_id', 'bk_img_url', 'bk_title')->latest()->get();
        return view('user.home', ['title' => 'Halaman Home'], compact('book_new'));
    }

    public function profile_page()
    {
        $user = User::where('usr_id', Auth::user()->usr_id)
            ->with('roles')
            ->get()
            ->first();
        return view('user.profile', ['title' => 'Halaman Profile'], compact('user'));
    }

    public function search_book_page()
    {
        return view('user.book.search', ['title' => 'Halaman Cari Buku']);
    }

    public function detail_book_page($id)
    {
        $book = Book::select('bk_id', 'bk_isbn', 'bk_title', 'bk_description', 'bk_page', 'bk_img_url', 'bk_type', 'bk_edition_volume', 'bk_published_year', 'bk_publisher_id', 'bk_major_id')->with('authors:athr_id,athr_name', 'major:bk_mjr_id,bk_mjr_class,bk_mjr_major', 'publisher:pub_id,pub_name','deweyDecimalClassfications:ddc_id,ddc_code',)->find($id);
        return view('user.book.detail', ['title' => 'Halaman Detail Buku'], compact('book'));
    }

    public function view_transaction_page()
    {
        return view('user.transaction.view', ['title' => 'Halaman Kelola Peminjaman']);
    }

    public function add_transaction_page()
    {
        return view('user.transaction.add', ['title' => 'Halaman Tambah Peminjaman']);
    }

    public function edit_transaction_page($id)
    {
        return view('user.transaction.edit', ['title' => 'Halaman Ubah Peminjaman']);
    }

    public function detail_transaction_page($id)
    {
        return view('user.transaction.detail', ['title' => 'Halaman Detail Peminjaman']);
    }
}
