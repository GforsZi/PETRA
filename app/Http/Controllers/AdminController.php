<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller {
    public function dashboard_page() {
        $user = User::with('roles:rl_id,rl_name')->find(Auth::user()->usr_id);
        $user_amount = User::select('usr_id')->where('usr_activation', true)->where('usr_role_id', '!=', null)->get()->count();
        $total_book = Book::select('bk_id')->get()->count();
        $total_transaction = Transaction::select()->get()->count();

        $days = 30;
        $startDate = Carbon::now()
            ->startOfDay()
            ->subDays($days - 1);
        $endDate = Carbon::now()->endOfDay();

        $raw = UserLogin::selectRaw('DATE(usr_lg_logged_in_at) as date, COUNT(*) as total')
            ->whereBetween('usr_lg_logged_in_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->pluck('total', 'date')
            ->toArray();

        $labels = [];
        $data = [];

        for ($i = 0; $i < $days; $i++) {
            $day = $startDate->copy()->addDays($i);
            $key = $day->toDateString();
            $labels[] = $day->format('d M');
            $data[] = isset($raw[$key]) ? (int) $raw[$key] : 0;
        }

        $tableRows = [];
        for ($i = 0; $i < $days; $i++) {
            $day = $startDate->copy()->addDays($i);
            $key = $day->toDateString();
            $tableRows[] = [
                'date' => $key,
                'label' => $day->format('d F Y'),
                'total' => isset($raw[$key]) ? (int) $raw[$key] : 0
            ];
        }

        $dataD = DB::table('transactions')->select('trx_status', DB::raw('COUNT(*) as total'))->groupBy('trx_status')->pluck('total', 'trx_status')->toArray();

        $chartData = [
            'proses' => $dataD['1'] ?? 0,
            'diterima' => $dataD['2'] ?? 0,
            'dikembalikan' => $dataD['3'] ?? 0,
            'ditolak' => $dataD['4'] ?? 0
        ];

        return view('admin.dashboard', ['title' => 'Halaman Dasboard'], compact('user', 'user_amount', 'total_book', 'total_transaction', 'labels', 'data', 'tableRows', 'days', 'chartData'));
    }

    public function activation_page() {
        $user = User::select('usr_id', 'name', 'usr_no_wa', 'usr_role_id', 'usr_card_url', 'usr_created_at')
            ->with('roles')
            ->find(Auth::user()->usr_id);
        return view('admin.activation', ['title' => 'Halaman Aktifasi'], compact('user'));
    }

    public function activation_system(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $validateData = null;
        $user = Auth::user();
        if ($request->hasFile('image')) {
            $destinationPath = public_path('media/card_img/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move($destinationPath, $filename);

            $validateData['usr_card_url'] = 'media/card_img/' . $filename;
        }
        $user->update($validateData);
        return redirect('/admin/profile')->with('success', 'Berhasil mengaktifasi akun');
    }

    public function profile_page() {
        $user = User::where('usr_id', Auth::user()->usr_id)
            ->with('roles')
            ->get()
            ->first();
        return view('admin.profile', ['title' => 'Halaman Profile'], compact('user'));
    }
    public function profile_edit_page() {
        $user = User::select('usr_id', 'name', 'usr_bio', 'usr_card_url', 'usr_no_wa')->find(Auth::user()->usr_id);
        return view('admin.edit', ['title' => 'Halaman ubah Profile'], compact('user'));
    }

    public function edit_profile_system(Request $request) {
        $user = User::find(Auth::user()->usr_id);
        $validateData = $request->validate([
            'name' => 'sometimes | required | string | max:255',
            'usr_bio' => 'sometimes | nullable | string | max:255'
        ]);

        if ($request->usr_no_wa != $user['usr_no_wa']) {
            $no_wa = $request->validate([
                'usr_no_wa' => 'sometimes | required | regex:/^[0-9]+$/ | unique:users,usr_no_wa| phone:ID'
            ]);
            $validateData['usr_no_wa'] = $no_wa['usr_no_wa'];
        }

        $user->update($validateData);
        return redirect('/admin/profile')->with('success', 'Profile Berhasil Diubah');
    }
}
