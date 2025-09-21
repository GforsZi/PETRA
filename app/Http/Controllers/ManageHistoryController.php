<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\DeweyDecimalClassfication;
use App\Models\Publisher;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ManageHistoryController extends Controller
{
    public function manage_history_page(Request $request) {
        $search = $request->query();
        if (!$search || !isset($search['category'])) {
            $search = 'all';
            $histories = null;
        } else {
            $history = $search['category'];
            switch ($history) {
                case 'Account':
                    $histories = User::onlyTrashed()->select('usr_id as id', 'usr_no_wa as title', 'usr_deleted_at as deleted_at', )->latest()->paginate(10);
                    return view('history.view', ['title' => 'Halaman Kelola Riwayat', 'histories' => $histories]);
                break;
                case 'Role':
                    $histories = Role::onlyTrashed()->select('rl_id as id', 'rl_name as title', 'rl_deleted_at as deleted_at', )->latest()->paginate(10);
                    return view('history.view', ['title' => 'Halaman Kelola Riwayat', 'histories' => $histories, 'page' => 'role/']);
                break;
                case 'Author':
                    $histories = Author::onlyTrashed()->select('athr_id as id', 'athr_name as title', 'athr_deleted_at as deleted_at', )->latest()->paginate(10);
                    return view('history.view', ['title' => 'Halaman Kelola Riwayat', 'histories' => $histories, 'page' => 'book/author/']);
                break;
                case 'Publisher':
                    $histories = Publisher::onlyTrashed()->select('pub_id as id', 'pub_name as title', 'pub_deleted_at as deleted_at', )->latest()->paginate(10);
                    return view('history.view', ['title' => 'Halaman Kelola Riwayat', 'histories' => $histories, 'page' => 'book/publisher/']);
                break;
                case 'DeweyDecimalClassfication':
                    $histories = DeweyDecimalClassfication::onlyTrashed()->select('ddc_id as id', 'ddc_code as title', 'ddc_deleted_at as deleted_at', )->latest()->paginate(10);
                    return view('history.view', ['title' => 'Halaman Kelola Riwayat', 'histories' => $histories, 'page' => 'book/ddc/']);
                break;
                default:
                    $histories = null;
                    return view('history.view', ['title' => 'Halaman Kelola Riwayat', 'histories' => $histories]);
                break;
                }
            }
            return view('history.view', ['title' => 'Halaman Kelola Riwayat', 'histories' => $histories]);
    }

    public function detail_histroy_page($id) {
        return view('history.detail', ['title' => 'Halaman Detail Riwayat']);
    }

}
