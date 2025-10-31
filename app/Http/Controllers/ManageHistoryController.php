<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\BookMajor;
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
        $search = $request->query();
        if (!$search || !isset($search['category'])) {
            $search = 'all';
            $histories = null;
        } else {
            $history = $search['category'];
            switch ($history) {
                case 'Account':
                    $histories = User::onlyTrashed()->select('usr_id as id', 'usr_no_wa as title', 'usr_deleted_at as deleted_at')->latest()->paginate(10);
                    return view('history.view', [
                        'title' => 'Halaman kelola riwayat',
                        'histories' => $histories,
                        'page_url' => '/manage/account',
                    ]);
                    break;
                case 'Role':
                    $histories = Role::onlyTrashed()->select('rl_id as id', 'rl_name as title', 'rl_deleted_at as deleted_at')->latest()->paginate(10);
                    return view('history.view', [
                        'title' => 'Halaman kelola riwayat',
                        'histories' => $histories,
                        'page_url' => '/manage/role',
                    ]);
                    break;
                case 'Author':
                    $histories = Author::onlyTrashed()->select('athr_id as id', 'athr_name as title', 'athr_deleted_at as deleted_at')->latest()->paginate(10);
                    return view('history.view', [
                        'title' => 'Halaman kelola riwayat',
                        'histories' => $histories,
                        'page_url' => '/manage/book/author',
                    ]);
                    break;
                case 'Publisher':
                    $histories = Publisher::onlyTrashed()->select('pub_id as id', 'pub_name as title', 'pub_deleted_at as deleted_at')->latest()->paginate(10);
                    return view('history.view', [
                        'title' => 'Halaman kelola riwayat',
                        'histories' => $histories,
                        'page_url' => '/manage/book/publisher',
                    ]);
                    break;
                case 'DeweyDecimalClassfication':
                    $histories = DeweyDecimalClassfication::onlyTrashed()->select('ddc_id as id', 'ddc_code as title', 'ddc_deleted_at as deleted_at')->latest()->paginate(10);
                    return view('history.view', [
                        'title' => 'Halaman kelola riwayat',
                        'histories' => $histories,
                        'page_url' => '/manage/book/ddc',
                    ]);
                    break;
                case 'BookMajor':
                    $histories = BookMajor::onlyTrashed()->select('bk_mjr_id as id', 'bk_mjr_class as title', 'bk_mjr_deleted_at as deleted_at')->latest()->paginate(10);
                    return view('history.view', [
                        'title' => 'Halaman kelola riwayat',
                        'histories' => $histories,
                        'page_url' => '/manage/book/major',
                    ]);
                    break;
                case 'Book':
                    $histories = Book::onlyTrashed()->select('bk_id as id', 'bk_title as title', 'bk_deleted_at as deleted_at')->latest()->paginate(10);
                    return view('history.view', [
                        'title' => 'Halaman kelola riwayat',
                        'histories' => $histories,
                        'page_url' => '/manage/book',
                    ]);
                    break;
                case 'ChatOption':
                    $histories = ChatOption::onlyTrashed()->select('cht_opt_id as id', 'cht_opt_title as title', 'cht_opt_deleted_at as deleted_at')->latest()->paginate(10);
                    return view('history.view', [
                        'title' => 'Halaman kelola riwayat',
                        'histories' => $histories,
                        'page_url' => '/manage/chat/option',
                    ]);
                    break;
                case 'Transaction':
                    $histories = Transaction::onlyTrashed()->select('trx_id as id', 'trx_title as title', 'trx_deleted_at as deleted_at')->latest()->paginate(10);
                    return view('history.view', [
                        'title' => 'Halaman kelola riwayat',
                        'histories' => $histories,
                        'page_url' => '/manage/transaction',
                    ]);
                    break;
                default:
                    $histories = null;
                    return view('history.view', ['title' => 'Halaman kelola riwayat', 'histories' => $histories], compact('pages'));
                    break;
            }
        }

        $pages = [
            [
                'title' => 'Riwayat akun',
                'page' => '/manage/history?category=Account',
            ],
            [
                'title' => 'Riwayat peran',
                'page' => '/manage/history?category=Role',
            ],
            [
                'title' => 'Riwayat buku',
                'page' => '/manage/history?category=Book',
            ],
            [
                'title' => 'Riwayat penerbit',
                'page' => '/manage/history?category=Publisher',
            ],
            [
                'title' => 'Riwayat klasifikasi',
                'page' => '/manage/history?category=DeweyDecimalClassfication',
            ],
            [
                'title' => 'Riwayat jurusan buku',
                'page' => '/manage/history?category=BookMajor',
            ],
            [
                'title' => 'Riwayat opsi chat',
                'page' => '/manage/history?category=ChatOption',
            ],
            [
                'title' => 'Riwayat transaksi',
                'page' => '/manage/history?category=Transaction',
            ],
        ];
        return view('history.view', ['title' => 'Halaman kelola riwayat', 'histories' => $histories], compact('pages'));
    }

    public function restore_system(Request $request, $id)
    {
        switch ($request->model) {
            case 'Account':
                $histories = User::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history?category=Account')->with('success', 'Data berhasil dipulishkan');
                break;
            case 'Role':
                $histories = Role::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history?category=Role')->with('success', 'Data berhasil dipulishkan');
                break;
            case 'Author':
                $histories = Author::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history?category=Author')->with('success', 'Data berhasil dipulishkan');
                break;
            case 'Publisher':
                $histories = Publisher::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history?category=Publisher')->with('success', 'Data berhasil dipulishkan');
                break;
            case 'DeweyDecimalClassfication':
                $histories = DeweyDecimalClassfication::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history?category=DeweyDecimalClassfication')->with('success', 'Data berhasil dipulishkan');
                break;
            case 'BookMajor':
                $histories = BookMajor::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history?category=BookMajor')->with('success', 'Data berhasil dipulishkan');
                break;
            case 'Book':
                $histories = Book::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history?category=Book')->with('success', 'Data berhasil dipulishkan');
                break;
            case 'ChatOption':
                $histories = ChatOption::onlyTrashed()->find($id);
                if ($histories->cht_opt_type == '1') {
                    $option = ChatOption::select('cht_opt_type')->where('cht_opt_type', '1')->count();
                    if ($option >= 1) {
                        return redirect('/manage/history?category=ChatOption')->with('error', 'Data Gagal Dipulihkan');
                        exit();
                    }
                } elseif ($histories->cht_opt_type == '2') {
                    $option = ChatOption::select('cht_opt_type')->where('cht_opt_type', '2')->count();
                    if ($option >= 1) {
                        return redirect('/manage/history?category=ChatOption')->with('error', 'Data Gagal Dipulihkan');
                        exit();
                    }
                }
                $histories->restore();
                return redirect('/manage/history?category=ChatOption')->with('success', 'Data berhasil dipulishkan');
                break;
            case 'BookCopy':
                $histories = BookCopy::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history?category=BookCopy')->with('success', 'Data berhasil dipulishkan');
                break;
            case 'Transaction':
                $histories = Transaction::onlyTrashed()->find($id);
                $histories->restore();
                return redirect('/manage/history?category=Transaction')->with('success', 'Data berhasil dipulishkan');
                break;
            default:
                return redirect('/manage/history')->with('Error', 'Tidak Ada Data Untuk Dipulihkan');
                break;
        }
    }
}
