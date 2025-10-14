<?php

namespace App\Http\Controllers;

use App\Models\BookCopy;
use App\Models\BookTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManageTransactionController extends Controller
{
    public function manage_loan_page() {
        $loans = Transaction::select('trx_id', 'trx_title', 'trx_borrow_date', 'trx_due_date', 'trx_status', 'trx_user_id')->with('users')->where('trx_status', '1')->latest()->paginate(10);
        return view('transaction.loan.view', ['title' => 'Halaman Kelola Pinjaman'], compact('loans'));
    }

    public function manage_return_page() {
        $returns = Transaction::select('trx_id', 'trx_borrow_date', 'trx_due_date', 'trx_return_date', 'trx_status', 'trx_user_id')->with('users')->where('trx_status', '2')->paginate(10);
        return view('transaction.return.view', ['title' => 'Halaman Kelola Pengembalian'], compact('returns'));
    }

    public function detail_transaction_page($id) {
        $transaction = Transaction::withTrashed()->with('books', 'book_copies', 'users', 'created_by', 'updated_by', 'deleted_by')->find($id);
        return view('transaction.detail', ['title' => 'Halaman Detail Transaksi'], compact('transaction'));
    }

    public function add_transaction_system(Request $request)
    {
        $validateData = $request->validate([
            'trx_title' => 'required|in:1,2',
            'trx_description' => 'nullable|string',
            'trx_borrow_date' => 'required|date',
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'integer|exists:books,bk_id',
        ]);
        DB::beginTransaction();
        try {
            // Simpan transaksi utama
            $transaction = Transaction::create([
                'trx_user_id' => Auth::id(),
                'trx_borrow_date' => $request->trx_borrow_date,
                'trx_status' => '1',
                'trx_title' => $request->trx_title,
                'trx_description' => $request->trx_description,
                'trx_created_by' => Auth::id(),
            ]);

            // Simpan relasi buku yang dipinjam
            if ($request->trx_title == '2') {
                foreach ($request->book_ids as $bookId) {
                    $copy = BookCopy::select('bk_cp_status', 'bk_cp_id')->where('bk_cp_book_id', $bookId)->where('bk_cp_status', '1')->get()->first()->toArray();
                    if ($copy['bk_cp_status'] == '1') {
                        BookCopy::find($copy['bk_cp_id'])->update(['bk_cp_status' => '2']);
                        BookTransaction::create([
                            'bk_trx_book_id' => $bookId,
                            'bk_trx_book_copy_id' => $copy['bk_cp_id'],
                            'bk_trx_transaction_id' => $transaction->trx_id,
                        ]);
                    } else {
                        return redirect('/transaction/add')->with('error', 'Gagal menyimpan peminjaman');
                        exit;
                    }
                }
            } else {
                foreach ($request->book_ids as $bookId) {
                    $copy = BookCopy::select('bk_cp_status', 'bk_cp_id')->where('bk_cp_book_id', $bookId)->where('bk_cp_status', '1')->get()->first()->toArray();
                    $copyId = BookCopy::select('bk_cp_id')->where('bk_cp_book_id', $bookId)->where('bk_cp_status', '1')->get();
                    if ($copy['bk_cp_status'] == '1') {
                        foreach ($copyId as $cp_id) {
                            BookCopy::find($cp_id['bk_cp_id'])->update(['bk_cp_status' => '2']);
                        }
                        BookTransaction::create([
                            'bk_trx_book_id' => $bookId,
                            'bk_trx_transaction_id' => $transaction->trx_id,
                        ]);
                    } else {
                        return redirect('/transaction/add')->with('error', 'Gagal menyimpan peminjaman');
                        exit;
                    }
                }
            }


            DB::commit();
            return redirect('/transaction')->with('success', 'peminjaman berhasil diajukan');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect('/transaction/add')->with('error', 'Gagal menyimpan peminjaman: ' . $e->getMessage());
        }

        dd($validateData);
    }

    public function approve_transaction_system(Request $request, $id) {
        $loan = Transaction::find($id);
        $request->validate([
            'datetime' => ['required', 'date']
        ]);
        $trx_due_date = Carbon::createFromFormat('Y-m-d\TH:i', $request->datetime);

        $loan->update([
            'trx_status' => '2',
            'trx_due_date' => $trx_due_date
        ]);
        return redirect('/manage/transaction/'.$id.'/detail')->with('success', 'Transaksi berhasil diterima');
    }

    public function reject_transaction_system(Request $request, $id) {
        $loan = Transaction::with('book_copies')->find($id);
        $copyID = BookTransaction::select('bk_trx_id','bk_trx_book_copy_id')->where('bk_trx_transaction_id', $id)->get()->toArray();
        if ($loan->book_copies->toArray() != []) {
            foreach ($copyID as $copyId) {
                BookCopy::find($copyId['bk_trx_book_copy_id'])->update(['bk_cp_status' => '1']);
            }
        } else {
            foreach ($request->all_book_ids as $copy) {
                $copyB = BookCopy::select('bk_cp_number', 'bk_cp_id')->where('bk_cp_book_id', $copy)->where('bk_cp_status', '2')->get()->toArray();
                foreach ($copyB as $idC) {
                    BookCopy::find($idC['bk_cp_id'])->update(['bk_cp_status' => '1']);
                }
            }
        }


        $loan->update(['trx_status' => '4']);
        return redirect('/manage/transaction/'.$id.'/detail')->with('success', 'Transaksi berhasil ditolak');
    }

    public function delete_transaction_system($id) {
        Transaction::find($id)->delete();
        return redirect('/manage/transaction/'.$id.'/detail')->with('success', 'Transaksi berhasil dihapus');
    }
}
