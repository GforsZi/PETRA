<?php

namespace App\Http\Controllers;

use App\Exports\CollectionExport;
use App\Exports\MembershipExport;
use App\Exports\TransactionExport;
use App\Models\Role;
use App\Models\UserLogin;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Spatie\Browsershot\Browsershot;

class ExportsController extends Controller
{
    public function memberships_export_page()
    {
        $roles = Role::all();
        return view('reports.member', compact('roles'));
    }

    public function collection_export_page()
    {
        return view('reports.collection');
    }

    public function transaction_export_page()
    {
        return view('reports.transaction');
    }

    public function statistics_export_page(Request $request)
    {
        $start = $request->query('start') ? Carbon::createFromFormat('Y-m-d', $request->query('start'))->startOfDay() : Carbon::now()->startOfMonth();
        $end = $request->query('end') ? Carbon::createFromFormat('Y-m-d', $request->query('end'))->endOfDay() : Carbon::now()->endOfMonth();

        // ambil agregasi per hari dari DB
        $rows = DB::table('user_logins') // ganti nama tabel jika berbeda
            ->selectRaw('DATE(usr_lg_logged_in_at) as date, COUNT(*) as cnt')
            ->whereBetween('usr_lg_logged_in_at', [$start->toDateTimeString(), $end->toDateTimeString()])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // buat range tanggal harian
        $period = CarbonPeriod::create($start->toDateString(), $end->toDateString());

        $labels = [];
        $data = [];
        $table = []; // array of rows for table

        foreach ($period as $date) {
            $d = $date->format('Y-m-d');
            $labels[] = $date->format('d M Y'); // label human readable
            $cnt = isset($rows[$d]) ? (int) $rows[$d]->cnt : 0;
            $data[] = $cnt;
            $table[] = [
                'date' => $d,
                'label' => $date->format('d M Y'),
                'detail' => $date->format('Y-m-d'),
                'count' => $cnt,
            ];
        }

        return view('reports.monthly', [
            'labels' => $labels,
            'data' => $data,
            'table' => $table,
            'start' => $start->toDateString(),
            'end' => $end->toDateString(),
        ]);
    }

    public function detail_statistics_export_page(Request $request, $date)
    {
        $dates = Carbon::createFromFormat('Y-m-d', $date);

        $logins = UserLogin::with('user:usr_id,name')
            ->whereBetween('usr_lg_logged_in_at', [
                $dates->copy()->startOfDay(),
                $dates->copy()->endOfDay(),
            ])
            ->get();

        return view('reports.detail_login', compact('logins', 'date'));
    }

    public function export_statistics_Pdf(Request $request)
    {
        // parsing tanggal (sama logic seperti index)
        $start = $request->query('start') ? Carbon::createFromFormat('Y-m-d', $request->query('start'))->startOfDay() : Carbon::now()->startOfMonth();
        $end = $request->query('end') ? Carbon::createFromFormat('Y-m-d', $request->query('end'))->endOfDay() : Carbon::now()->endOfMonth();

        $rows = DB::table('user_logins')
            ->selectRaw('DATE(usr_lg_logged_in_at) as date, COUNT(*) as cnt')
            ->whereBetween('usr_lg_logged_in_at', [$start->toDateTimeString(), $end->toDateTimeString()])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $period = CarbonPeriod::create($start->toDateString(), $end->toDateString());

        $labels = [];
        $data = [];
        $table = [];
        foreach ($period as $date) {
            $d = $date->format('Y-m-d');
            $labels[] = $date->format('d M Y');
            $cnt = isset($rows[$d]) ? (int) $rows[$d]->cnt : 0;
            $data[] = $cnt;
            $table[] = [
                'date' => $d,
                'label' => $date->format('d M Y'),
                'count' => $cnt,
            ];
        }

        // siapkan view HTML (view khusus untuk PDF)
        $html = view('reports.statistic', [
            'labels' => $labels,
            'data' => $data,
            'table' => $table,
            'start' => $start->toDateString(),
            'end' => $end->toDateString(),
        ])->render();

        // path output
        $filename = 'login-stats-' . $start->format('Ymd') . '-' . $end->format('Ymd') . '.pdf';
        $outputPath = storage_path('app/public/reports/' . $filename);

        // Generate PDF via Browsershot
        $bs = Browsershot::html($html)
            ->noSandbox() // jika lingkungan butuh
            ->showBackground() // tampilkan background CSS
            ->format('A4')
            ->landscape()
            // Tunggu until chart sukses render; kita pakai waitForFunction on window.chartReady
            ->waitUntilNetworkIdle()
            ->waitForFunction('window.chartReady === true')
            // set viewport agar Chart.js render proporsional
            ->windowSize(1200, 800)
            ->save($outputPath);

        return response()->download($outputPath, $filename)->deleteFileAfterSend(true);
    }

    public function export_statistics_date_Pdf(Request $request, $date)
    {
        $dates = Carbon::createFromFormat('Y-m-d', $date);

        $logins = UserLogin::with('user:usr_id,name')
            ->whereBetween('usr_lg_logged_in_at', [
                $dates->copy()->startOfDay(),
                $dates->copy()->endOfDay(),
            ])->get();

        // siapkan view HTML (view khusus untuk PDF)
        $html = view('reports.statistic_date', [
            'logins' => $logins,
            'date' => $date
        ])->render();

        $filename = 'login-stats-date-' . $date . '.pdf';
        $outputPath = storage_path('app/public/reports/' . $filename);

        $bs = Browsershot::html($html)
            ->noSandbox()
            ->showBackground()
            ->format('A4')
            ->landscape()
            ->save($outputPath);

        return response()->download($outputPath, $filename)->deleteFileAfterSend(true);
    }

    public function memberships_export_system(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'roles' => 'nullable|array',
            'columns' => 'nullable|array',
        ]);

        // Jika user centang 'print_all', kosongkan rentang tanggal
        $startDate = $request->has('print_all') ? null : $request->start_date;
        $endDate = $request->has('print_all') ? null : $request->end_date;

        $filename = 'Laporan_Anggota_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new MembershipExport($startDate, $endDate, $request->roles, $request->columns), $filename);
    }

    public function collection_export_system(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'columns' => 'required|array|min:1',
            'all_data' => 'nullable|boolean',
        ]);

        $filename = 'Laporan_Koleksi_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new CollectionExport($request->start_date, $request->end_date, $request->boolean('all_data'), (array) $request->columns), $filename);
    }

    public function transaction_export_system(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'columns' => 'nullable|array',
            'print_all' => 'nullable|in:on',
            'status' => 'nullable|array', // opsional filter status
        ]);

        // jika user memilih Cetak Semua Data (checkbox), abaikan tanggal
        $start = $request->has('print_all') ? null : $request->input('start_date');
        $end = $request->has('print_all') ? null : $request->input('end_date');

        $columns = $request->input('columns', ['trx_id', 'user_name', 'books', 'book_copies', 'trx_borrow_date', 'trx_due_date', 'trx_return_date', 'trx_status']);

        $filename = 'Laporan_Transaksi_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new TransactionExport($start, $end, $columns, $request->input('status')), $filename);
    }
}
