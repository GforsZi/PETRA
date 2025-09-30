<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageTransactionController extends Controller
{
    public function manage_loan_page() {
        return view('transaction.loan.view', ['title' => 'Halaman Kelola Pinjaman']);
    }

    public function manage_return_page() {
        return view('transaction.return.view', ['title' => 'Halaman Kelola Pengembalian']);
    }

    public function add_transaction_page()
    {
        return view('user.transaction.add', ['title' => 'Halaman Tambah Transaksi']);
    }

    public function edit_transaction_page($id)
    {
        return view('user.transaction.edit', ['title' => 'Halaman Ubah Transaksi']);
    }
}
