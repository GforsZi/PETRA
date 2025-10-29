<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function home_page()
    {
        $book_new = Book::select('bk_id', 'bk_img_url', 'bk_title')->limit(14)->latest()->get();
        $book_loan = Book::select('bk_id', 'bk_img_url', 'bk_title')
            ->withCount(['transactions as total_loans' => function ($query) {
                $query->whereNull('trx_deleted_at');
            }])
            ->orderByDesc('total_loans')
            ->latest('bk_created_at')
            ->limit(14)
            ->get();
        $dataD = DB::table('transactions')->where('trx_user_id', Auth::id())->select('trx_status', DB::raw('COUNT(*) as total'))->groupBy('trx_status')->pluck('total', 'trx_status')->toArray();

        $chartData = [
            'proses' => $dataD['1'] ?? 0,
            'diterima' => $dataD['2'] ?? 0,
            'dikembalikan' => $dataD['3'] ?? 0,
            'ditolak' => $dataD['4'] ?? 0,
        ];
        $loan = Transaction::select('trx_id', 'trx_user_id')->where('trx_user_id', Auth::id())->get()->count();
        return view('user.home', ['title' => 'Halaman Home'], compact('book_new', 'book_loan', 'chartData', 'loan'));
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
        $user = User::select('usr_id', 'name', 'usr_bio', 'usr_card_url', 'usr_no_wa')->find(Auth::user()->usr_id);
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

    public function activation_page()
    {
        $user = User::select('usr_id', 'name', 'usr_no_wa', 'usr_role_id', 'usr_card_url', 'usr_created_at')
            ->with('roles')
            ->find(Auth::user()->usr_id);
        return view('user.activation', ['title' => 'Halaman Aktifasi'], compact('user'));
    }

    public function activation_system(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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
        return redirect('/user/profile')->with('success', 'Berhasil mengaktifasi akun');
    }

    public function search_book_page()
    {
        $book_new = Book::select('bk_id', 'bk_img_url', 'bk_title')->limit(14)->latest()->get();
        return view('user.book.search', ['title' => 'Halaman Cari Buku'], compact('book_new'));
    }

    public function search_name_book_page($name)
    {
        $books = Book::where('bk_title', 'like', "%{$name}%")
            ->select('bk_id', 'bk_title', 'bk_img_url')
            ->get();
        return response()->json($books);
    }

    public function detail_book_page($id)
    {
        $book = Book::select('bk_id', 'bk_isbn', 'bk_title', 'bk_description', 'bk_page', 'bk_img_url', 'bk_type', 'bk_edition_volume', 'bk_published_year', 'bk_publisher_id', 'bk_major_id')
            ->with('authors:athr_id,athr_name', 'major:bk_mjr_id,bk_mjr_class,bk_mjr_major', 'publisher:pub_id,pub_name', 'deweyDecimalClassfications:ddc_id,ddc_code,ddc_description')
            ->find($id);
        return view('user.book.detail', ['title' => 'Halaman Detail Buku'], compact('book'));
    }

    public function google_search_book_system(Request $request)
    {
        $query = $request->query('q');

        if (empty($query)) {
            return response()->json([
                'error' => 'Query pencarian tidak boleh kosong.'
            ], 400);
        }

        $apiKey = env('GOOGLE_BOOKS_API_KEY');

        try {
            $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
                'q' => $query,
                'maxResults' => 12,
                'key' => $apiKey,
            ]);

            // Pastikan API berhasil
            if ($response->failed()) {
                return response()->json([
                    'error' => 'Gagal mengambil data dari Google Books.'
                ], 500);
            }

            return response()->json($response->json());
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan internal server.',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function google_search_book_page()
    {
        return view('user.web.search');
    }

    public function google_detail_book_page()
    {
        return view('user.web.detail');
    }

    public function read_ebook_page($id)
    {
        $book = Book::findOrFail($id);

        $safeTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $book->bk_title);
        $folderPath = public_path('media/pdf-image/' . $safeTitle);

        $images = [];
        if (file_exists($folderPath)) {
            $files = File::files($folderPath);
            sort($files);
            foreach ($files as $file) {
                $images[] = asset('media/pdf-image/' . $safeTitle . '/' . basename($file));
            }
        }

        return view('user.book.ebook', ['title' => 'Halaman Detail Buku'], compact('book', 'images'));
    }

    public function view_transaction_page()
    {
        $transactions = Transaction::select('trx_id', 'trx_borrow_date', 'trx_due_date', 'trx_title', 'trx_status')->with('books')
            ->where('trx_user_id', Auth::user()->usr_id)
            ->latest()
            ->paginate(10);
        return view('user.transaction.view', ['title' => 'Halaman Kelola Peminjaman'], compact('transactions'));
    }
    public function add_transaction_page()
    {
        return view('user.transaction.add', ['title' => 'Halaman Tambah Peminjaman']);
    }

    public function detail_transaction_page($id)
    {
        $transaction = Transaction::withTrashed()
            ->with(['books', 'book_copies', 'users', 'created_by', 'updated_by', 'deleted_by'])
            ->findOrFail($id);

        $uniqueBooks = $transaction->books->unique('bk_id')->values();

        $copiesGrouped = $transaction->book_copies->groupBy('bk_cp_book_id')->map(function ($copies) {
            return $copies->unique('bk_cp_number')->sortBy('bk_cp_number')->values();
        });
        return view('user.transaction.detail', [
            'title' => 'Halaman Detail Peminjaman',
            'transaction' => $transaction,
            'books' => $uniqueBooks,
            'copiesGrouped' => $copiesGrouped,
        ]);
    }
}
