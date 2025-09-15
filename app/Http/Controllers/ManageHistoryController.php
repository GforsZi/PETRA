<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageHistoryController extends Controller
{
    public function manage_history_page() {
        return view('history.view', ['title' => 'Halaman Kelola Riwayat']);
    }

    public function detail_histroy_page($id) {
        return view('history.detail', ['title' => 'Halaman Detail Riwayat']);
    }

}
