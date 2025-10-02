<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ManageTransactionController extends Controller
{
    public function manage_loan_page() {
        $loans = Transaction::select('trx_id', 'trx_borrow_date', 'trx_due_date', 'trx_status', 'trx_user_id')->with('users')->paginate(10);
        return view('transaction.loan.view', ['title' => 'Halaman Kelola Pinjaman'], compact('loans'));
    }

    public function manage_return_page() {
        $returns = Transaction::select('trx_id', 'trx_borrow_date', 'trx_due_date', 'trx_return_date', 'trx_status', 'trx_user_id')->with('users')->paginate(10);
        return view('transaction.return.view', ['title' => 'Halaman Kelola Pengembalian'], compact('returns'));
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
