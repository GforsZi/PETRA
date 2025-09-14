<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageTransactionController extends Controller
{
    public function add_transaction_page() {
        return view('user.transaction.add', ['title' => 'Halaman Tambah Transaksi']);
    }

    public function edit_transaction_page($id) {
        return view('user.transaction.edit', ['title' => 'Halaman Ubah Transaksi']);
    }
}
