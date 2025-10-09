<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
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
    public function profile_edit_page()
    {
        $user = User::select('usr_id', 'name', 'usr_bio', 'usr_img_url', 'usr_no_wa')->find(Auth::user()->usr_id);
        return view('user.edit', ['title' => 'Halaman ubah Profile'], compact('user'));
    }

    public function edit_profile_system(Request $request)
    {
        $user = User::find(Auth::user()->usr_id);
        $validateData = $request->validate([
            'name' => 'sometimes | required | string | max:255',
            'usr_bio' => 'sometimes | nullable | string | max:255',
        ]);

        if ($request->usr_no_wa != $user['usr_no_wa']) {
            $no_wa = $request->validate([
                'usr_no_wa' => 'sometimes | required | regex:/^[0-9]+$/ | unique:users,usr_no_wa| phone:ID',
            ]);
            $validateData['usr_no_wa'] = $no_wa['usr_no_wa'];
        }

        $user->update($validateData);
        return redirect('/user/profile')->with('success', 'Profile Berhasil Diubah');
    }

    public function search_book_page()
    {
        $book_new = Book::select('bk_id', 'bk_img_url', 'bk_title')->latest()->get();
        return view('user.book.search', ['title' => 'Halaman Cari Buku'], compact('book_new'));
    }

    public function search_name_book_page($name)
    {
        $books = Book::where('bk_title', 'like', "%{$name}%")
                    ->select('bk_id','bk_title','bk_img_url')
                    ->get();
        return response()->json($books);
    }

    public function detail_book_page($id)
    {
        $book = Book::select('bk_id', 'bk_isbn', 'bk_title', 'bk_description', 'bk_page', 'bk_img_url', 'bk_type', 'bk_edition_volume', 'bk_published_year', 'bk_publisher_id', 'bk_major_id')->with('authors:athr_id,athr_name', 'major:bk_mjr_id,bk_mjr_class,bk_mjr_major', 'publisher:pub_id,pub_name','deweyDecimalClassfications:ddc_id,ddc_code',)->find($id);
        return view('user.book.detail', ['title' => 'Halaman Detail Buku'], compact('book'));
    }

    public function view_transaction_page()
    {
        $transactions = Transaction::select('trx_id', 'trx_borrow_date', 'trx_due_date', 'trx_title', 'trx_status')->where('trx_user_id', Auth::user()->usr_id)->latest()->paginate(10);
        return view('user.transaction.view', ['title' => 'Halaman Kelola Peminjaman'], compact('transactions'));
    }
        public function add_transaction_page()
    {
        return view('user.transaction.add', ['title' => 'Halaman Tambah Peminjaman']);
    }

    public function detail_transaction_page($id)
    {
        $transaction = Transaction::with('users', 'books')->find($id);
        return view('user.transaction.detail', ['title' => 'Halaman Detail Peminjaman'], compact('transaction'));
    }
}
