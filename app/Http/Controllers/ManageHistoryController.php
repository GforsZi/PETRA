<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\BookMajor;
use App\Models\BookOrigin;
use App\Models\ChatOption;
use App\Models\Device;
use App\Models\DeweyDecimalClassfication;
use App\Models\Publisher;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class ManageHistoryController extends Controller
{

    public function manage_history_page(Request $request)
    {
        $pages = [
            [
                'title' => 'Riwayat akun',
                'page' => '/manage/history/account',
            ],
            [
                'title' => 'Riwayat peran',
                'page' => '/manage/history/role',
            ],
            [
                'title' => 'Riwayat buku',
                'page' => '/manage/history/book',
            ],
            [
                'title' => 'Riwayat penerbit',
                'page' => '/manage/history/publisher',
            ],
            [
                'title' => 'Riwayat sumber',
                'page' => '/manage/history/origin',
            ],
            [
                'title' => 'Riwayat klasifikasi',
                'page' => '/manage/history/classification',
            ],
            [
                'title' => 'Riwayat jurusan buku',
                'page' => '/manage/history/major',
            ],
            [
                'title' => 'Riwayat opsi chat',
                'page' => '/manage/history/option',
            ],
            [
                'title' => 'Riwayat transaksi',
                'page' => '/manage/history/transaction',
            ],
        ];
        return view('history.view', ['title' => 'Halaman kelola riwayat'], compact('pages'));
    }

    public function manage_account_history_page()
    {
        $histories = User::onlyTrashed()->select('usr_id', 'name', 'usr_no_wa', 'usr_deleted_at')->latest()->paginate(10);
        return view('history.account', [
            'title' => 'Halaman kelola riwayat',
            'histories' => $histories,
            'page_url' => '/manage/account',
        ]);
    }

    public function manage_role_history_page()
    {
        $histories = Role::onlyTrashed()->select('rl_id', 'rl_name', 'rl_deleted_at')->latest()->paginate(10);
        return view('history.role', [
            'title' => 'Halaman kelola riwayat',
            'histories' => $histories,
            'page_url' => '/manage/role',
        ]);
    }

    public function manage_author_history_page()
    {
        $histories = Author::onlyTrashed()->select('athr_id', 'athr_name', 'athr_deleted_at')->latest()->paginate(10);
        return view('history.author', [
            'title' => 'Halaman kelola riwayat',
            'histories' => $histories,
            'page_url' => '/manage/author',
        ]);
    }

    public function manage_publisher_history_page()
    {
        $histories = Publisher::onlyTrashed()->select('pub_id', 'pub_name', 'pub_address', 'pub_deleted_at')->latest()->paginate(10);
        return view('history.publisher', [
            'title' => 'Halaman kelola riwayat',
            'histories' => $histories,
            'page_url' => '/manage/publisher',
        ]);
    }

    public function manage_major_history_page()
    {
        $histories = BookMajor::onlyTrashed()->select('bk_mjr_id', 'bk_mjr_class', 'bk_mjr_major', 'bk_mjr_deleted_at')->latest()->paginate(10);
        return view('history.major', [
            'title' => 'Halaman kelola riwayat',
            'histories' => $histories,
            'page_url' => '/manage/major',
        ]);
    }

    public function manage_origin_history_page()
    {
        $histories = BookOrigin::onlyTrashed()->select('bk_orgn_id', 'bk_orgn_name', 'bk_orgn_deleted_at')->latest()->paginate(10);
        return view('history.origin', [
            'title' => 'Halaman kelola riwayat',
            'histories' => $histories,
            'page_url' => '/manage/origin',
        ]);
    }

    public function manage_book_history_page()
    {
        $histories = Book::onlyTrashed()->select('bk_id', 'bk_title', 'bk_isbn', 'bk_publisher_id', 'bk_deleted_at')->with('publisher')->latest()->paginate(10);
        return view('history.book', [
            'title' => 'Halaman kelola riwayat',
            'histories' => $histories,
            'page_url' => '/manage/book',
        ]);
    }

    public function manage_option_history_page()
    {
        $histories = ChatOption::onlyTrashed()->select('cht_opt_id', 'cht_opt_title', 'cht_opt_deleted_at')->latest()->paginate(10);
        return view('history.option', [
            'title' => 'Halaman kelola riwayat',
            'histories' => $histories,
            'page_url' => '/manage/chat/option',
        ]);
    }

    public function manage_transaction_history_page()
    {
        $histories = Transaction::onlyTrashed()->select('trx_id', 'trx_title', 'trx_description', 'trx_user_id', 'trx_deleted_at')->latest()->paginate(10);
        return view('history.transaction', [
            'title' => 'Halaman kelola riwayat',
            'histories' => $histories,
            'page_url' => '/manage/transaction',
        ]);
    }

    public function manage_classification_history_page()
    {
        $histories = DeweyDecimalClassfication::onlyTrashed()->select('ddc_id', 'ddc_code', 'ddc_description', 'ddc_deleted_at')->latest()->paginate(10);
        return view('history.classification', [
            'title' => 'Halaman kelola riwayat',
            'histories' => $histories,
            'page_url' => '/manage/ddc',
        ]);
    }

    public function restore_system(Request $request, $id)
    {
        switch ($request->model) {
            case 'Account':
                $histories = User::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history/account')->with('success', 'Data berhasil dipulihkan');
                break;
            case 'Role':
                $histories = Role::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history/role')->with('success', 'Data berhasil dipulihkan');
                break;
            case 'Author':
                $histories = Author::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history/author')->with('success', 'Data berhasil dipulihkan');
                break;
            case 'Publisher':
                $histories = Publisher::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history/publisher')->with('success', 'Data berhasil dipulihkan');
                break;
            case 'Classification':
                $histories = DeweyDecimalClassfication::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history/classification')->with('success', 'Data berhasil dipulihkan');
                break;
            case 'Major':
                $histories = BookMajor::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history/major')->with('success', 'Data berhasil dipulihkan');
                break;
            case 'Origin':
                $histories = BookOrigin::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history/origin')->with('success', 'Data berhasil dipulihkan');
                break;
            case 'Book':
                $histories = Book::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history/book')->with('success', 'Data berhasil dipulihkan');
                break;
            case 'Option':
                $histories = ChatOption::onlyTrashed()->find($id);
                if ($histories->cht_opt_type == '1') {
                    $option = ChatOption::select('cht_opt_type')->where('cht_opt_type', '1')->count();
                    if ($option >= 1) {
                        return redirect('/manage/history/option')->with('error', 'Data gagal dipulihkan');
                        exit();
                    }
                } elseif ($histories->cht_opt_type == '2') {
                    $option = ChatOption::select('cht_opt_type')->where('cht_opt_type', '2')->count();
                    if ($option >= 1) {
                        return redirect('/manage/history/option')->with('error', 'Data gagal dipulihkan');
                        exit();
                    }
                }
                $histories->restore();
                return redirect('/manage/history/option')->with('success', 'Data berhasil dipulihkan');
                break;
            case 'Transaction':
                $histories = Transaction::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history/transaction')->with('success', 'Data berhasil dipulihkan');
                break;
            default:
                return redirect('/manage/history')->with('Error', 'Tidak Ada Data Untuk Dipulihkan');
                break;
        }
    }
}
